<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $validationRules = [
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
    ];

    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    public function show(Book $book)
    {
        return response()->json($book);
    }

    public function store(Request $request)
    {
        $request->validate($this->validationRules);

        $book = Book::create($request->all());
        return response()->json($book, 201);
    }

    public function update(Request $request, Book $book)
    {
        $request->validate($this->validationRules);

        $book->update($request->all());
        return response()->json($book);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(null, 204);
    }
}
