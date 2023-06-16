@extends('layouts.backend.app')

@section('title','Admin | Purchases | Add')

@push('css')

<!-- JQuery Select Css -->
<link href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
<link rel="stylesheet" href="{{ asset('backend/tags-input/bootstrap-tagsinput.css') }}">
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
                                    <label class="form-label">Select Product</label>
                                    <select name="product" id="product" class="form-control show-tick" required>
                                        <option value="">Select Product</option>
                                        @foreach( $products as $data)
                                        <option value="{{ $data->id }}" {{ $data->id == old('product') ? 'selected' : '' }}>{{ $data->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="serial" id="serial" required value="0">
                                <input type="hidden" name="license" id="license" required value="0">

                                <div class="form-group form-float">
                                    <label class="form-label">Unit Price</label>
                                    <div class="form-line">
                                        <input type="number" id="unit_price" name="unit_price" class="form-control" value="{{ old('unit_price') }}" oninput="calTotal()" required>

                                    </div>
                                </div>
                                
                                
                                
                                <div class="form-group form-float">
                                    <label class="form-label">Total Price</label>
                                    <div class="form-line">
                                        <input type="text" id="total_price" name="total_price" class="form-control"  value="{{ old('total_price') }}" required disabled>
                            
                                    </div>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <label class="form-label">Select Supplier</label>
                                    <select name="supplier" id="supplier" class="form-control show-tick" required>
                                        <option value="">Select Supplier</option>
                                        @foreach( $suppliers as $data)
                                        <option value="{{ $data->id }}" {{ $data->id == old('supplier') ? 'selected' : '' }}>{{ $data->company }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Quantity</label>
                                    <div class="form-line">
                                        <input type="number"  id="quantity" name="quantity" class="form-control" value="1" min="1" required oninput="calTotal()">
                            
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Date of Purchase</label>
                                    <div class="form-line">
                                        <input type="text" name="date_of_purchase" id="date_of_purchase" onchange="calDate()" value="{{ old('date_of_join') }}" class="datepicker form-control" placeholder="Please choose Joining date..." required>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row d-none" id="license-show">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"> <span id="wat">Warranty Period</span>(Month)</label>
                                    <div class="form-line">
                                        <input class="form-control" onchange="calDate()" type="text" id="month" name="month">


                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"> <span id="expt"> Expired Date </span></label>

                                    <div class="form-line">
                                        <input class="form-control" type="text" name="month" id="expired_date" disabled>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row d-none" id="sl-show">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Serial NO</label>
                                    <div class="form-line">
                                        <input class="form-control tagsinp" type="text" id="serials" name="serials" data-role="tagsinput">



                                    </div>
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
<script src="{{ asset('backend/tags-input/bootstrap-tagsinput.min.js') }}"></script>

<script>

    $("#quantity").val();

    $('#form_submit').click(function(){
        
        let qty = $("#quantity").val();
        let serials = $('#serials').val();
        console.log(serials);

        let count = serials.split(",").length;


        if( serials == '' ){
            $('#purchase_form').submit();

        }else {
            if( count == qty){
                $('#purchase_form').submit();

            }else{
                alert('Quantity and Serials not match');
            }

        }

    });

    

    function calTotal(){
        //alert('ok');
        quantity = $("#quantity").val();

        var unit_price = $("#unit_price").val();
    
        $('.tagsinp').data('count', quantity);
        var count = $('.tagsinp').data('count');
        console.log(count);


        // var total_price = $("#total_price").val();
        var  total_price = unit_price * quantity;
        var total_price = Math.floor(total_price);
        //var total = parseInt(quantity) * parseFloat(unitPrice);
        //var total = parseInt(quantity) + parseInt(unitPrice);

        $('#total_price').val(total_price);

    }

    $('#product').change(function(){

        var id = $(this).val();
        var url = location.origin + '/admin/products/' + id;
    
        $.get(url, function(data) {
            console.log(data);
            if(data['is_serial'] == 1){
                $('#sl-show').removeClass('d-none');
                $('#serial').val(1);
            }else {
                $('#sl-show').addClass('d-none');
                $('#serial').val(0);
            }

            if(data['producttype_id'] == 6){
                $('#wat').text('Subscription Preiod');
                $('#expt').text('Subscription Date');

            }else {
                $('#wat').text('Warranty Period')
                $('#expt').text('Expired Date')

            }


            if(data['is_license'] == 1){
                $('#license-show').removeClass('d-none');
                $('#license').val(1);


            }else {
                $('#license-show').addClass('d-none');
                $('#license').val(1);
            }
        });
        
    });
    
    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        clearButton: true,
        weekStart: 1,
        time: false
    });

    $('input .tagsinp').tagsinput({
        // maxTags: 2,
        itemValue: function(item) {
            return item.toUpperCase();
        },


        // onTagExists: function(item, $tag) {
        //     $tag.hide.fadeIn();
        // },      

    });

    $('.tagsinp').on('beforeItemAdd', function(event) {
        return event.item.toUpperCase();

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




</script>

@endpush
