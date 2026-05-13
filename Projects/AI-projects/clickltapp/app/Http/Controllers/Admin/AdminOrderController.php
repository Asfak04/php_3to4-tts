<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $searchInt = intval(str_replace('ORD-', '', strtoupper($search)));
                $q->where('id', $searchInt ?: null)
                  ->orWhere('id', 'like', "%{$search}%")
                  ->orWhere('transaction_id', 'like', "%{$search}%")
                  ->orWhereHas('user', function($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10)->withQueryString();
        $statusOptions = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        
        return view('admin.orders.index', compact('orders', 'statusOptions'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $oldStatus = $order->status;
        $order->update(['status' => $request->status]);

        if ($oldStatus !== $request->status) {
            $order->load(['user', 'items.product']);
            if ($request->status === 'shipped') {
                \Illuminate\Support\Facades\Mail::to($order->user->email)->send(new \App\Mail\OrderShippedMail($order));
            } elseif ($request->status === 'delivered') {
                \Illuminate\Support\Facades\Mail::to($order->user->email)->send(new \App\Mail\OrderDeliveredMail($order));
            }
        }

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
