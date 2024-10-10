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

    /**
     * @OA\Get(
     *     path="/books",
     *     operationId="booksAll",
     *     tags={"Pages"},
     *     summary="Display a listing of the resource",
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Book not found"
     *     )
     * )
     */

    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    /**
     * @OA\Get(
     *     path="/books/{id}",
     *     operationId="bookShow",
     *     tags={"Pages"},
     *     summary="Display a specific book resource",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the book to retrieve",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Book found"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Book not found"
     *     )
     * )
     */
    public function show(Book $book)
    {
        return response()->json($book);
    }

    /**
     * @OA\Post(
     *     path="/books",
     *     operationId="bookCreate",
     *     tags={"Post"},
     *     summary="Create yet another post in database",
     *     security={
     *         {"app_id" : {}},
     *     },
     *     @OA\Response(
     *         response="200",
     *         description="Everithing is fine"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookStoreRequest")
     *     ),
     * )
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules);

        $book = Book::create($request->all());
        return response()->json($book, 201);
    }

    /**
     * @OA\Put(
     *     path="/books/{id}",
     *     operationId="bookUpdate",
     *     tags={"Post"},
     *     summary="Update a specific book in the database",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the book to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     security={
     *         {"app_id" : {}}
     *     },
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookStoreRequest")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Book updated successfully"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Book not found"
     *     )
     * )
     */
    public function update(Request $request, Book $book)
    {
        $validationRules = array_merge($this->validationRules, [
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'price' => 'sometimes|required|numeric',
            'stock' => 'sometimes|required|integer',
        ]);

        $request->validate($validationRules);
        $book->update($request->only(array_keys($validationRules)));
        return response()->json($book);
    }

    /**
     * @OA\Delete(
     *     path="/books/{id}",
     *     operationId="bookDestroy",
     *     tags={"Pages"},
     *     summary="Delete a specific book from the database",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the book to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     security={
     *         {"app_id" : {}}
     *     },
     *     @OA\Response(
     *         response="204",
     *         description="Book deleted successfully"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Book not found"
     *     )
     * )
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(null, 204);
    }
}
