<?php

namespace App\Http\Controllers;

use App\Models\IteeBook;
use Exception;
use Illuminate\Http\Request;

class ITEEBooksController extends Controller
{
    public function index()
    {
        $books = IteeBook::all();
        return view('itee.books.index', compact('books'));
    }

    public function create()
    {
        return view('itee.books.create');
    }

    public function store(Request $request)
    {
        $validates = $request->validate([
            'book_name' => 'required|min:5',
            'book_price' => 'required|numeric',
            'status' => 'required|in:1,0',
        ]);

        try {
            if ($request->has('id')) {
                $book = IteeBook::find($request->id);
            } else {
                $book = new IteeBook();
            }

            $book->book_name = $request->book_name;
            $book->book_price = $request->book_price;
            $book->status = $request->status;
            if ($book->save()) {
                return redirect()->route('itee.books.index')->with('success', 'Book Save Successfully');
            } else {
                return redirect()->back()->withInput()->with('error', 'Book Save Failed');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Book Save Failed');
        }
    }

    public function view(Request $request, $id)
    {
        $book = IteeBook::findOrFail($request->id);
        return view('itee.books.view', compact('book'));
    }

    public function edit(Request $request, $id)
    {
        $book = IteeBook::findOrFail($request->id);
        return view('itee.books.edit', compact('book'));
    }

    public function delete($id)
    {
        $book = IteeBook::findOrFail($id);
        if ($book->delete()) {
            return redirect()->route('itee.books.index')->with('success', 'Book deleted successfully');
        }
        return redirect()->route('itee.books.index')->with('error', 'Something went wrong');
    }
}