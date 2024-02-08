<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FormField;
use App\Models\FormTemplate;
use App\Models\User;
use App\Models\UserFormData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormSubmissionController extends Controller
{
    public function formFieldCreate(Request $request)
    {
        $categories = Category::with('template')->get();
        $form_fields = FormField::with('category')->get();
        return view('admin.form.add-form-field', compact('form_fields', 'categories'));
    }

    public function formFieldStore(Request $request)
    {
        $this->validateForm($request->fields);
        $id = json_decode($request->form_template)->id;
        $data = FormField::updateOrCreate(
            ['id' => $id], // conditions to find the record
            [
                'form_data' => $request->fields,
                'category_id' => json_decode($request->form_template)->id
            ]
        );

        return redirect()->back();

    }

    private function validateForm($fields)
    {
        try {
            $containsNull = collect($fields)->flatten()->contains(null);

            if ($containsNull) {
                $validator = Validator::make([], []);
                $validator->errors()->add('null_values', 'At least one value is null');

                return redirect()->back()->withErrors($validator)->withInput();
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function viewForm($id)
    {
        $fields = FormField::find($id);
        return view('admin.form.view-form', compact('fields'));
    }

    public function userList()
    {
        $all_users = User::role(User::USER_ROLE)->get();
        return view('admin.user-index', compact('all_users'));
    }

    public function viewUser($id)
    {
        $all_data = user::with('userFormData')->where('id', $id)->first();
        return view('user.index', compact('all_data'));
    }
}
