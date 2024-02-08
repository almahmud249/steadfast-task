@extends('layouts.app')

@section('content')
    <div>
        <div class="main_container">
            <div class="body_container">
                <div style="overflow-x: hidden;" class="body_wraper p-md-5 p-3">
                    <div class="cm_box mb-5 p-0">
                        <div class="cm_box px-5 py-4">
                            <p class="mb-0">Dynamic Form</p>
                        </div>
                        <form action="{{route('user.submit.form')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="common_input mb-5 col-md-6">
                                <label for="category">Select Category</label>
                                <select name="category_id" id="category"
                                        onchange="getRequest('{{ url('/') }}/user/get-form-template/'+this.value,'template_select','select')">
                                    <option value="">Select Category</option>
                                @foreach($categories as $key => $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="p-5 mb-5">
                                <div class="row" id="dynamicFieldsContainer"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- navbar end -->
        </div>
    </div>
@endsection

@push('script')
    <script>
        function getRequest(route, id, type) {
            $.get({
                url: route,
                dataType: 'json',
                success: function (data) {
                    appendDynamicFields(data);
                },
            });
        }

        function appendDynamicFields(fieldsArray) {
            var container = $('#dynamicFieldsContainer');
            container.empty();
            $.each(fieldsArray.result, function (index, field) {
                if(field.type != 'radio' && field.type != 'checkbox' && field.type != 'submit' && field.type != 'button'){
                    var newRowHtml =
                        '<div class="common_input mb-5 col-md-3">' +
                        '<label for="dynamicField_' + index + '">' + field.label + '</label>' +
                        '<input type="'+ field.type +'" class="form-control" id="dynamicField_' + index + '" name="fields[' + index + ']['+ field.label +']" placeholder="' + field.label + '" value="" required>' +
                        '</div>';
                    container.append(newRowHtml);
                }
                else if(field.type === 'radio' || field.type === 'checkbox'){
                    var RadioCheckbox =
                        '<div class="common_input mb-5 col-md-3">' +
                        '<label for="dynamicField_' + index + '" class="title-color mb-0"">' + field.label + '</label>' +
                        '<input type="'+ field.type +'" class="nn_input" id="dynamicField_' + index + '" name="fields[' + index + ']['+ field.label +']" placeholder="' + field.label + '" value="male">' +
                        '<label for="dynamicField_' + index + '" class="title-color mb-0"">' + 'Male' + '</label>' +
                        '<input type="'+ field.type +'" class="nn_input" id="dynamicField_' + index + '" name="fields[' + index + ']['+ field.label +']" placeholder="' + field.label + '" value="female">' +
                        '<label for="dynamicField_' + index + '" class="title-color mb-0"">' + 'FeMale' + '</label>' +
                        '</div>';
                    container.append(RadioCheckbox);
                }
                if(field.type == 'submit' || field.type == 'button'){
                    container.append(
                        '<div class="common_input col-md-3 mt-7">' +
                        '<div class="text-center"><button class="btn btn-primary btn-lg mx-auto mx-lg-0 ms-lg-auto" id="submitButton">Submit</button></div>' +
                        '</div>'
                    );
                }
            });

        }
    </script>
@endpush
