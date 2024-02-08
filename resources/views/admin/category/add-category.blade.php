@extends('layouts.app')

@section('content')
    <div style="height: 100vh;" class="body_wraper p-md-5 p-3 ">
            <div class="login_box cm_box">
                <form action="{{route('admin.category.store')}}">
                    <div class="row">
                        <div class="common_input mb-5 col-md-6">
                            <label for>Category Name</label>
                            <input class="nn_input"
                                   placeholder="Enter category name..."
                                   type="text" name="name">
                            <x-input-error style="color:red" :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="common_input mb-5 col-md-6">
                            <label for>Description</label>
                            <textarea class="form-control" name="description" rows="5" placeholder="description"></textarea>
                        </div>
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
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $key => $cat)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>
                            <span class="d-block">{{$cat->name}}</span>
                        </td>
                        <td>
                            <span class="d-block">{{$cat->description}}</span>
                        </td>
                        <td>
                            <a href="{{route('admin.category.delete', $cat->id)}}" method="get">
                                <i class="fa-solid fa-trash"></i>                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
