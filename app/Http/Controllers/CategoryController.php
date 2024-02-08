<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryCreate()
    {
        $categories = Category::all();
        return view('admin.category.add-category', compact('categories'));
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->back();
    }

    public function categoryDelete($id)
    {
        Category::where('id', $id)->delete();
        return redirect()->back();
    }
}
