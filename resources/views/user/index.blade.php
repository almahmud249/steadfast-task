@extends('layouts.app')

@section('content')
    <div class="body_wraper p-md-5 p-3 ">
        <div class="table_responsive">
            <table>
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Value</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_data->userFormData as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <span class="d-block">{{ @$data->category->name }}</span>
                        </td>
                        <td>
                            @foreach($data->value as $nestedArray)
                                @foreach($nestedArray as $field => $value)
                                    <span class="d-block"><strong>{{ $field }}:</strong> {{ $value }}</span>
                                @endforeach
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
