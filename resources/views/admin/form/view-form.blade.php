@extends('layouts.app')

@section('content')
    <div style="height: 100vh;" class="body_wraper p-md-5 p-3 ">
        <div>
            <div class="login_box cm_box row">
                @foreach($fields->form_data as $field)
                    <div class="common_input mb-5 col-md-3">
                        <label>{{ $field['label'] }}</label>
                        @if($field['type'] == 'radio')
                                <input class="nn_input" name="seller_pos" type="{{$field['type']}}" value="1" id="seller_pos1">
                                <label class="title-color mb-0" for="seller_pos1">
                                    Male
                                </label>
                                <input class="nn_input" name="seller_pos" type="{{$field['type']}}" value="0" id="seller_pos2" checked="">
                                <label class="title-color mb-0" for="seller_pos2">
                                    Female
                                </label>
                        @elseif($field['type'] == 'checkbox')
                            <input class="nn_input" name="seller_pos" type="{{$field['type']}}" value="1" id="seller_pos1">
                            <label class="title-color mb-0" for="seller_pos1">
                                HTML
                            </label>
                            <input class="nn_input" name="seller_pos" type="{{$field['type']}}" value="0" id="seller_pos2" checked="">
                            <label class="title-color mb-0" for="seller_pos2">
                                CSS
                            </label>
                            <input class="nn_input" name="seller_pos" type="{{$field['type']}}" value="0" id="seller_pos2" checked="">
                            <label class="title-color mb-0" for="seller_pos2">
                                JavaScript
                            </label>
                        @else
                            <input class="nn_input"
                                   placeholder="Enter {{$field['label']}}"
                                   type="{{$field['type']}}">
                        @endif

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
