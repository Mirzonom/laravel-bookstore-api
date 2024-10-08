<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $validationRules = [
        'name' => 'required|string|max:255'
    ];

    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function show(Category $category)
    {
        return response()->json($category);
    }

    public function store(Request $request)
    {
        $request->validate($this->validationRules);

        $category = Category::create($request->all());
        return response()->json($category, 201);
    }


    public function update(Request $request, Category $category)
    {
        $request->validate($this->validationRules);

        $category->update($request->all());
        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
