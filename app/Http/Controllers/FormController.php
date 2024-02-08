<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FormTemplate;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function formCreate()
    {
        $forms = FormTemplate::all();
        $categories = Category::all();
        return view('admin.form.add-form', compact('forms','categories'));
    }

    public function formStore(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        FormTemplate::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);
        return redirect()->back();
    }
}
