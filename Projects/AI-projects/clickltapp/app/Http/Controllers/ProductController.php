<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmedMail;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');

        $query = Product::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::with([
            'products' => function ($q) {
                $q->latest()->take(6);
            }
        ])->get();

        return view('product', compact('products', 'categories'));
    }

    public function PoductsDetails($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('product_details', compact('product'));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $product = Product::findOrFail($productId);
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image,
                "unit" => $product->unit
            ];
        }

        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function cart()
    {
        $cart = Session::get('cart', []);
        return view('cart', compact('cart'));
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = Session::get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            Session::put('cart', $cart);
            return response()->json(['success' => true]);
        }
    }

    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $cart = Session::get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                Session::put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Product removed successfully');
        }
    }

    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            return to_route('login')->with('error', 'Please login to checkout');
        }

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty');
        }

        foreach ($cart as $id => $details) {
            if (!Product::find($id)) {
                unset($cart[$id]);
                Session::put('cart', $cart);
                return to_route('cart')->with('error', 'An item in your cart is no longer available and was removed. Please retry.');
            }
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        if ($total > 0) {
            $total += 10; // Add delivery charge
        }

        $paymentMethod = $request->input('payment_method', 'COD');
        $paymentStatus = ($paymentMethod === 'COD') ? 'pending' : 'paid';
        $transactionId = 'TXN-' . strtoupper(uniqid()) . '-' . time();

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $total,
            'status' => 'pending',
            'address' => $request->input('address', 'Sample Address'),
            'payment_method' => $paymentMethod,
            'transaction_id' => $transactionId,
            'payment_status' => $paymentStatus,
        ]);

        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        Session::forget('cart');

        Mail::to(Auth::user()->email)->send(new OrderConfirmedMail($order));

        return to_route('orders')->with('success', 'Order placed successfully!');
    }

    public function createRazorpayOrder(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $cart = Session::get('cart', []);
        foreach ($cart as $id => $details) {
            if (!Product::find($id)) {
                unset($cart[$id]);
                Session::put('cart', $cart);
                return response()->json(['error' => 'An item in your cart is no longer available. Please refresh the page.'], 400);
            }
        }
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        if ($total > 0) {
            $total += 10;
        }

        $api = new \Razorpay\Api\Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $orderInfo = [
            'receipt' => 'receipt_' . time(),
            'amount' => intval($total * 100), // in paise
            'currency' => 'INR',
            'payment_capture' => 1 // auto capture
        ];

        try {
            $razorpayOrder = $api->order->create($orderInfo);
            return response()->json([
                'order_id' => $razorpayOrder['id'],
                'amount' => intval($total * 100)
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function verifyRazorpayPayment(Request $request)
    {
        $success = true;
        $error = "Payment Failed";

        if (empty($request->razorpay_payment_id) === false) {
            $api = new \Razorpay\Api\Api(config('services.razorpay.key'), config('services.razorpay.secret'));

            try {
                $attributes = array(
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature
                );
                $api->utility->verifyPaymentSignature($attributes);
            } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
                $success = false;
                $error = 'Razorpay Error : ' . $e->getMessage();
            }
        } else {
            $success = false;
        }

        if ($success === true) {
            $cart = Session::get('cart', []);
            foreach ($cart as $id => $details) {
                if (!Product::find($id)) {
                    unset($cart[$id]);
                }
            }
            if (empty($cart)) {
                return to_route('cart')->with('error', 'The items in your cart are no longer available.');
            }
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            if ($total > 0) {
                $total += 10;
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'status' => 'pending',
                'address' => $request->input('address', 'Online Request Address'),
                'payment_method' => 'Razorpay',
                'transaction_id' => $request->razorpay_payment_id,
                'payment_status' => 'paid',
            ]);

            foreach ($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);
            }
            Session::forget('cart');

            Mail::to(Auth::user()->email)->send(new OrderConfirmedMail($order));

            return to_route('orders')->with('success', 'Order placed and paid successfully via Razorpay!');
        } else {
            return to_route('cart')->with('error', $error);
        }
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())->with('items.product')->latest()->get();
        return view('orders', compact('orders'));
    }

    public function downloadInvoice(Order $order)
    {
        // Security check: Only the owner can download the invoice
        if ($order->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $order->load(['user', 'items.product']);

        $pdf = Pdf::loadView('invoice', compact('order'));

        return $pdf->download('invoice_OR-' . str_pad($order->id, 5, '0', STR_PAD_LEFT) . '.pdf');
    }
}
