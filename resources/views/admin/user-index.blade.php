@extends('layouts.app')

@section('content')
    <div style="height: 100vh;" class="body_wraper p-md-5 p-3 ">
        <p>All Users</p>
        <div class="table_responsive">
            <table>
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>email</th>
                    <th>action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_users as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <span class="d-block">{{ $user->name }}</span>
                        </td>
                        <td>
                            <span class="d-block">{{ $user->email }}</span>
                        </td>
                        <td>
                            <a href="{{route('admin.view.user', $user->id)}}" method="get">
                                <i
                                    class="fa-solid fa-eye action_icon"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
