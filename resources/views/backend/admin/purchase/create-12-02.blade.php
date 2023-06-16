@extends('layouts.backend.app')

@section('title','Admin | Purchases | Add')

@push('css')

<link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
<link href="{{ asset('backend/select2/select2.min.css') }}" rel="stylesheet" />

<style>
    .d-none {
        display: none;
    }
    /* .bootstrap-tagsinput .label-info{
        text-transform: uppercase;
    } */
  

</style>
@endpush
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <a href="{{ route('admin.purchases.index') }}" class="btn btn-primary waves-effect pull-right" style="margin-bottom:10px;" >
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
                        Add Purchase
                        
                    </h2>
                </div>
                <div class="body">
                    <form action="{{ route('admin.purchases.store')}}" method="post" enctype="multipart/form-data" id="purchase_form">
                            @csrf
                        <div class="row">
                            <div class="col-md-6 "> <!-- col-md-offset-3 -->
                                <div class="form-group form-float">
                                    <label class="form-label">Product Type </label>
                                    <select name="product_type" id="product_type" class="form-control" required >
                                        <option value="">Select Product Type </option>
                            
                                        @foreach( $types as $data)
                                        <option value="{{ $data->id }}"> {{ $data->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label class="form-label">Select Product</label>
                                    <select name="product" id="product" class="form-control" required>
                                        <option value="">Select Product</option>
                                    </select>
                                    <label id="product-error" class="error" for="product"></label>

                                </div>
                                <input type="hidden" name="serial" id="serial" required value="0">
                                <input type="hidden" name="license" id="license" required value="0">

                                <div class="form-group">
                                    <label class="form-label">Unit Price</label>
                                    <input type="number" id="unit_price" name="unit_price" class="form-control" value="{{ old('unit_price') }}" oninput="calTotal()" required>
                                </div>
                                
                                
                                
                                <div class="form-group ">
                                    <label class="form-label">Total Price</label>
                                    <input type="text" id="total_price" name="total_price" class="form-control"  value="{{ old('total_price') }}" required disabled>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-label">Select Supplier</label>
                                    <select name="supplier" id="supplier" class="form-control show-tick" required>
                                        <option value="">Select Supplier</option>
                                        @foreach( $suppliers as $data)
                                        <option value="{{ $data->id }}" {{ $data->id == old('supplier') ? 'selected' : '' }}>{{ $data->company }}</option>
                                        @endforeach
                                    </select>
                                    <label id="supplier-error" class="error" for="supplier"></label>

                                </div>
                                <div class="form-group">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1" required oninput="calTotal()">

                                </div>
                                <div class="form-group">
                                    <label class="form-label">Date of Purchase</label>
                                    <input type="text" name="date_of_purchase" id="date_of_purchase" onchange="calDate()" value="{{ old('date_of_join') }}" class="datepicker form-control" placeholder="Please choose Purchase Date..." required>
                                </div>
                            </div>
                        </div>
                        <div class="row d-none" id="license-show">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"> <span id="wat">Warranty Period</span>(Month)</label>
                                    <input class="form-control" onchange="calDate()" type="text" id="month" name="month">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"> <span id="expt"> Expired Date </span></label>

                                    <div class="">
                                        <input class="form-control" type="text" name="month" id="expired_date" disabled>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row d-none" id="sl-show">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Serial NO</label>
                                    
                                    <select class="form-control" id="serials" name="serials[]" multiple data-minimum-results-for-search="Infinity">
                                    </select>
                                    <label id="serials-error" class="error" for="serials"></label>


                                </div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <button type="button" id="form_submit" class="btn btn-success btn-lg custom-btn" >Save</button>
                        </div>

                    </form>
                </div>
            
            </div>
        </div>
    </div>

</div>

@endsection

@push('js')
<!-- Moment Plugin Js -->
<script src="{{ asset('backend/plugins/momentjs/moment.js') }}"></script>
<script src="{{ asset('backend/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<script src="{{ asset('backend/select2/select2.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.validate.min.js') }}"></script>


<script>

    $("#quantity").val();

    $('#form_submit').click(function(){
        
        let serials = $('#serials').val();

        if( serials == null ){
            $("#purchase_form").validate();
            $('#purchase_form').submit();

        }else {
            let qty = $("#quantity").val();
            

            let count = serials.length;
            if( count == qty){
                $('#purchase_form').submit();

            }else{
                alert('Quantity and Serials not match');
            }

        }

    });

    

    function calTotal(){

        quantity = $("#quantity").val();

        var unit_price = $("#unit_price").val();

        var  total_price = unit_price * quantity;
        var total_price = Math.floor(total_price);

        $('#total_price').val(total_price);

    }


    $('#product_type').change(function(e){
        e.preventDefault();
        console.log('ok');
        var typeId = $(this).val();
        var url = location.origin + '/admin/purchases/typed/' + typeId;
        if(typeId) {
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                success:function(data)
                {
                    console.log(data);
                    if(data){
                        $('#product').empty();
                        $('#product').append('<option hidden>Select Product</option>'); 
                        $.each(data, function(key, product){
                            $('select[name="product"]').append('<option value="'+ product.id +'">' +product.title+ '-'+ product.brand +'-'+ product.model +'</option>');
                        });
                    }else{
                        $('#product').empty();
                    }
                }
            });
        }
    });


    $('#product').change(function(){

        var id = $(this).val();

        var url = location.origin + '/admin/purchases/product/' + id;

        $.get(url, function(data) {

            if(data['is_serial'] == 1){
                $('#sl-show').removeClass('d-none');
                $('#serial').val(1);
                $('#serials').attr('required', true);
            }else {
                $('#sl-show').addClass('d-none');
                $('#serial').val(0);
                $('#serials').attr('required', false);

            }

            if(data['type'] == 'software'){
                $('#wat').text('Subscription Preiod');
                $('#expt').text('Subscription Date');

            }else {
                $('#wat').text('Warranty Period')
                $('#expt').text('Expired Date')

            }


            if(data['is_license'] == 1){
                $('#license-show').removeClass('d-none');
                $('#license').val(1);
                $('#month').attr('required', true);

            }else {
                $('#license-show').addClass('d-none');
                $('#license').val(0);
                $('#month').attr('required', false);

            }
        });
        
    });
    
    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        clearButton: true,
        weekStart: 1,
        time: false
    });


    function calDate(event){
        var dt = $('#date_of_purchase').val();
        var warenty = parseInt($('#month').val());

        var date_of_purchase = new Date(dt);

        if(warenty > 0){
            date_of_purchase.setMonth(date_of_purchase.getMonth() + warenty);

            const yyyy = date_of_purchase.getFullYear();
            let mm = date_of_purchase.getMonth() + 1; // Months start at 0!
            let dd = date_of_purchase.getDate();

            if (dd < 10) dd='0' + dd; 
            if (mm < 10) mm='0' + mm; 
            const formattedToday=yyyy + '-' + mm + '-' + dd; 
            $('#expired_date').val(formattedToday);
        }


    }



    $(document).ready(function() {

        $('#serials').select2({
            tags: true,
            width: '100%',
            minimumResultsForSearch: -1,
            // maximumSelectionLength: quantity,
        });

        $('#supplier').select2();
        $('#product').select2();
        $('#product_type').select2();


    });

    





</script>

@endpush
