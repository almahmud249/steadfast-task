@extends('layouts.app')

@section('content')
    <div class="content container-fluid main-card" style="font-size: 20px">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header input-title">
                    <h4>Create Dynamic Form</h4>
                </div>
                <div class="card-body card-body-paddding">
                    <form method="POST" action="{{route('admin.form.field.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="shipping_fee_invoice_based">
                            <div class="d-flex justify-content-between mb-2">
                                <div class="col-lg-4 mb-4 mb-lg-">
                                    <p class="mb-0">Select Category</p>
                                    <div class="form-group suplr">
                                        <select class="js-example-theme-single js-states mb-2 form-control form_template"
                                                id="form_template" name="form_template" onchange="getRate()" required>
                                            <option value="{{ null }}" selected disabled></option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if($errors->first('null_values'))
                                        <div class="form-group">
                                            <div class="alert alert-danger">
                                                {{ $errors->first('null_values') }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" id="add-row-btn" class="btn btn-icon btn-sm btn-outline-primary add_row">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                              d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                                    </svg>
                                </button>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td>Label</td>
                                    <td>Type</td>
                                    <td>Action</td>
                                </tr>
                                </thead>
                                <tbody class="invoice_based_tbody">

                                </tbody>
                            </table>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-outline-primary" tabindex="4">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body card-body-paddding">
                    <div class="table_responsive">
                        <table>
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($form_fields as $key => $fields)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>
                                        <span class="d-block">{{$fields->category->name}}</span>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.view.form', $fields->id)}}" method="get">
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
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            let rowNumber = 1;

            $('#add-row-btn').click(function() {
                var rowCount = $('.invoice_based_tbody tr').length;
                rowNumber = rowNumber + rowCount;
                var newRowHtml = '<tr>' +
                    '<td>' +
                    '<input type="text" class="form-control" name="fields[' + rowNumber + '][label]" placeholder="Label" value="" required>' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" class="form-control" name="fields[' + rowNumber + '][type]" placeholder="Type" value="" required>' +
                    '</td>' +
                    '<td>' +
                    '<button type="button" class="btn btn-outline-danger delete-row-btn">Delete</button>' +
                    '</td>' +
                    '</tr>';
                $('.invoice_based_tbody').append(newRowHtml);
                rowNumber++;
            });

            $('.invoice_based_tbody').on('click', '.delete-row-btn', function() {
                $(this).closest('tr').remove();
            });

        });

        function getRate() {
            var form_template = JSON.parse($('#form_template').val());
            $('.invoice_based_tbody').html(null);
            let rowNumber = 0;

            if (form_template && form_template.template) {
                $.each(form_template.template.form_data, function(index, order) {
                    var newRowHtml = '<tr>' +
                        '<td>' +
                        '<input type="text" class="form-control" name="fields[' + rowNumber + '][label]" placeholder="Label" value="'+ order.label +'" required>' +
                        '</td>' +
                        '<td>' +
                        '<input type="text" class="form-control" name="fields[' + rowNumber + '][type]" placeholder="Type" value="'+ order.type +'" required>' +
                        '</td>' +
                        '<td>' +
                        '<button type="button" class="btn btn-outline-danger delete-row-btn">Delete</button>' +
                        '</td>' +
                        '</tr>';

                    $('.invoice_based_tbody').append(newRowHtml);
                    rowNumber++;
                });
            }
        }
    </script>
@endpush
