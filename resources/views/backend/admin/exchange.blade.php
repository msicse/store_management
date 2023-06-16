@extends('layouts.backend.app')

@section('title', 'Admin | Products')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/js/pages/tables/buttons.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/select2/select2.min.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <button type="button" class="btn btn-primary waves-effect pull-right" style="margin-bottom:10px;"
                data-toggle="modal" data-target="#createProduct">

                <i class="material-icons">add</i>
                <span>Add New Product</span>
            </button>

        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Print Exchange Info
                            <span class="badge "></span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Select Employee</th>
                                        <th>Old Product </th>
                                        <th>New Product </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label class="form-label" for="addType"> Select Employee </label>
                                                <select name="old-product" class="form-control" required>
                                                    <option value="">Select Employee </option>

                                                    @foreach ($employees as $type)
                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach

                                                </select>
                                                <label id="addType-error" class="error" for="addType"></label>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <label class="form-label" for="addType"> Select New Product </label>
                                                <select name="old-product" class="form-control" required>
                                                    <option value="">Select New Product </option>

                                                    @foreach ($newproducts as $type)
                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach

                                                </select>
                                                <label id="addType-error" class="error" for="addType"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label class="form-label" for="addType"> Select Old Product</label>
                                                <select name="old-product" class="form-control" required>
                                                    <option value="">Select Old Product</option>

                                                    @foreach ($newproducts as $type)
                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach

                                                </select>
                                                <label id="addType-error" class="error" for="addType"></label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>


@endsection

@push('js')
    <script src="{{ asset('backend/select2/select2.min.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.validate.min.js') }}"></script>




    <script>
        $('#employee').change(function(e) {
            e.preventDefault();
            console.log('ok');
            var typeId = $(this).val();
            var url = location.origin + '/admin/purchases/typed/' + typeId;
            if (typeId) {
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        if (data) {
                            $('#newProduct').empty();
                            $('#oldProduct').empty();
                            $('#product').append('<option hidden>Select Product</option>');
                            $.each(data, function(key, product) {

                                if (product.return_date == NULL) {
                                    $('select[name="newproduct"]').append('<option value="' +
                                        product
                                        .id + '">' + product.title + '-' + product.brand +
                                        '-' +
                                        product.model + '</option>');
                                } else {
                                    $('select[name="oldproduct"]').append('<option value="' +
                                        product
                                        .id + '">' + product.title + '-' + product.brand +
                                        '-' +
                                        product.model + '</option>');
                                }


                            });
                        } else {
                            $('#product').empty();
                        }
                    }
                });
            }
        });


        $(document).ready(function() {
            $('#addType').select2({
                width: '100%',
                dropdownParent: $('#createProduct'),
            });


            $('#type').select2({
                width: '100%',
                dropdownParent: $('#editModal'),
            });

        })

        $("#store_form").validate();
        $("#editForm").validate();
    </script>
@endpush
