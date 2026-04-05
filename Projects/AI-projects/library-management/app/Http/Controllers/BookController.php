<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with(['category', 'author'])->latest();
        
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
        
        if ($request->has('author') && $request->author != '') {
            $query->where('author_id', $request->author);
        }
        
        $books = $query->paginate(10);
        $categories = Category::all();
        $authors = Author::all();
        
        return view('books.index', compact('books', 'categories', 'authors'));
    }

    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();
        return view('books.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'total_quantity' => 'required|integer|min:1',
        ]);

        $data = $request->all();
        $data['available_quantity'] = $data['total_quantity'];

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        $authors = Author::all();
        return view('books.edit', compact('book', 'categories', 'authors'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'total_quantity' => 'required|integer|min:0',
        ]);

        $diff = $request->total_quantity - $book->total_quantity;
        
        $data = $request->all();
        // Prevent available quantity from dropping below zero if we reduce total quantity too much
        $newAvailable = $book->available_quantity + $diff;
        if ($newAvailable < 0) {
            return back()->withErrors(['total_quantity' => 'Cannot reduce total quantity below currently issued books.']);
        }
        
        $data['available_quantity'] = $newAvailable;
        
        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        if ($book->total_quantity > $book->available_quantity) {
             return back()->with('error', 'Cannot delete book. Some copies are currently issued.');
        }
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
