@extends('layouts.backend.app')

@section('title', 'Admin | Employees | Upload')

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <a href="{{ route('admin.employees.index') }}" class="btn btn-primary waves-effect pull-right"
                style="margin-bottom:10px;">
                <i class="material-icons">keyboard_return</i>
                <span>Return</span>
            </a>

        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Upload Stocks

                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.imports.stocks.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">

                                    <div class="form-group form-float">
                                        <label class="form-label">Employee File ( Excel )</label>
                                        <div class="form-line">
                                            <input type="file" name="stocks" class="form-control" required>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row text-center">
                                <input type="submit" class="btn btn-success btn-lg custom-btn" value="Save">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>


@endsection
