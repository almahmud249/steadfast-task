@extends('layouts.app')

@section('content')
    <div style="height: 100vh;" class="body_wraper p-md-5 p-3 ">
        <h1 class="box_title mb-5">Form Template</h1>

        <div class="login_box cm_box">
            <form action="{{route('admin.form.store')}}">
                <div class="row">
                    <div class="common_input mb-5 col-md-6">
                        <label for>Category</label>
                        <select name="category_id">
                            @foreach($categories as $key => $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="common_input mb-5 col-md-6">
                        <label for>Name</label>
                        <input class="nn_input"
                               placeholder="Enter name..."
                               type="text" name="name">
                    </div>
                </div>

                <div class="common_input mb-5">
                    <label for>Description</label>
                    <textarea class="form-control" name="description" rows="5" placeholder="description"></textarea>
                </div>
                <div class="common_input mb-5">
                    <button type="submit" class="py-4">Submit</button>
                </div>
            </form>
        </div>
        <div class="table_responsive">
            <table>
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                @foreach($forms as $key => $form)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>
                            <span class="d-block">{{$form->name}}</span>
                        </td>
                        <td>
                            <span class="d-block">{{$form->description}}</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
