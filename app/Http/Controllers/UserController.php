<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FormField;
use App\Models\FormTemplate;
use App\Models\User;
use App\Models\UserFormData;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userDashboard()
    {
        $categories = Category::all();
        $templates = [];
        return view('user.dashboard', compact('categories', 'templates'));
    }

    public function formTemplate(Request $request, $id)
    {
        $templates = FormField::where('category_id', $id)->first();
        if ($templates) {
            return response()->json([
                'result' => $templates->form_data,
            ]);
        } else {
            return response()->json([
                'result' => [],
            ]);
        }
    }

    public function submitForm(Request $request)
    {
        $modifiedFields = $request->fields;
        $file_fields = FormField::where('category_id', $request->category_id)->first();

        foreach ($file_fields->form_data as $key => $field) {
            $type = trim($field['type']);
            if ($type == 'file') {
                foreach ($modifiedFields as $i => $subArray) {
                    if (array_key_exists($field['label'], $subArray)) {
                        $imageName = $subArray[$field['label']]->getClientOriginalName();
                        $subArray[$field['label']] = $imageName;
                        $modifiedFields[$i] = $subArray;
                    }
                }
            }
        }
        UserFormData::create([
            'user_id' => \auth()->user()->id,
            'category_id' => $request->category_id,
            'value' => $modifiedFields,
        ]);
        return redirect()->back();
    }

    public function list()
    {
        $all_data = User::with('userFormData', 'userFormData.category')->where('id', \auth()->user()->id)->first();
        return view('user.index', compact('all_data'));
    }
}
