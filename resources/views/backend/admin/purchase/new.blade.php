
@extends('layout.admin')
@section('title','Accounts | Manage Accounts')

@section('styles')
<style>
    .panel-heading {
    padding: 17px;
}
</style>


@endsection

@section('contentBody')
<h1 class="text-center">Accounting & Bookkeeping</h1>
<div class="card">
    <div class="card-header">
        <h3>Add New Purchase </h3>
    </div>
    <div class="card-body card-padding">
        <form action="{{route('admin.purchases.store')}}" method="post">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Basic Information</h3>
                        </div>
                        <div class="panel-body ">
                            <table class="table">
                                <tr>
                                    <th>Purchase Code</th>
                                    <td><input type="text" class="form-control" name="purchase_code" readonly value="<?php echo substr(md5(rand(100000000, 200000000)), 0, 10); ?>" /></td>
                                </tr>
                                <tr>
                                    <th>Supplier <sup class="fa fa-star text-danger text-right" style="font-size: 12px;" aria-hidden="true"></sup></th>
                                    <td>
                                        <select required name="supplier_id" id="" class="form-control">
                                            <option value=""></option>
                                            @foreach($suppliers as $data)
                                                <option value="{{ $data->id }}">{{ $data->first_name  }} {{ $data->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Due Date</th>
                                    <td>
                                        <div class="input-group form-group">
                                            <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                                <div class="dtp-container">
                                                    <input type='text' class="form-control date-picker" placeholder="Click here..." id="due_date" name="due_date"  value="{{ Input::old('due_date')  }}" required />
                                                </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add Product/Service</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-2">
                                <select class="form-control">
                                   
                                    <optgroup label="Product">
                                        <option value=""></option>
                                        @foreach($products as $data)
                                            @if($data->type == 'product')
                                            <option   value="{{$data->id}}" onclick="addRow('purchTable',{{ $data->id }})" >-{{ $data->name }}</option>
                                            @endif
                                        @endforeach
                                   </optgroup>
                                   <optgroup label="Services">
                                        @foreach($inventories as $data)
                                            @if($data->type == 'service')
                                            <option  value="{{$data->id}}" onclick="addRow('purchTable',{{ $data->id }})" >-{{ $data->name }}</option>
                                            @endif
                                        @endforeach
                                  </optgroup>
                                </select> 
                            </div>
                            <div class="col-md-10 remove-padding">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="purchTable">
                                        <tr>
                                            <th>#</th>
                                            <th>product_code</th>
                                            <th>name</th>
                                            <th>quantity</th>
                                            <th>unit_price</th>
                                            <th>total</th>
											<th>Option<th>
                                            
                                        </tr>
                                </table>

                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Payment Information</h3>
                        </div>
                        <div class="panel-body table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Sub Total</th>
                                    <td><input type="number" id="sub_total" name="sub_total" readonly></td>
                                </tr>
                                
                                <tr>
                                    <th>Discount Amount <sup style="font-size: 12px;" class="fa fa-star text-danger text-right" aria-hidden="true"></sup></th>
                                    <td>
                                        <input required min="0" name="discount" type="number" value="0" class="form-control" id="discount" onkeyup="calculate_grand_total()" onclick="calculate_grand_total()" >
                                    </td>
                                </tr>
								<tr>
                                    <th>VAT</th>
                                    <td>
                                        <select name="vat_id" id="vat" class="form-control" onchange="calculate_grand_total()" >
                                            <option value="0" selected> sellect a vat</option>
                                            @foreach($vats as $data)
                                                <option value="{{ $data->id }}">{{ $data->name  }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Grand Total</th>
                                    <td>
                                        <input type="number" name="amount" id="amount" class="form-control" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Finantial Account <sup class="fa fa-star text-danger text-right" style="font-size: 12px;" aria-hidden="true"></sup></th>
                                    <td>
                                        <select name="account_id" id="" required class="form-control">
                                            <option value=""></option>
                                            @foreach($accounts as $data)
                                                <option value="{{ $data->id }}">{{ $data->title  }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
								

                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-4">
                    <button type="submit" class="btn  btn-primary btn-block">Purchase</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection


@section('scripts')
<!-- <script src="{{ url('vendors/bootgrid/jquery.bootgrid.updated.min.js') }}"></script> -->
<script type="text/javascript">


function addRow(tableID,id) {

        var table = document.getElementById(tableID);
        var url=location.origin+'/purchase/'+id;
                    
        $.get(url,function(data){

            var rowCount = table.rows.length;

            if(document.getElementById(id) == null) {

                var row = table.insertRow(rowCount);

                for( j=0;j<= rowCount; j++){
                    row.innerHTML = '<td>'+j+'</td>'+data;
                }


            }
            else
            {
                alert('Alredy Exsist');
            }
             
        });
}

    function calculate_single_entry_sum(entry_number)
    {
        //alert('hi');



        quantity            = $("#single_entry_quantity_"+entry_number).val();
        //alert(quantity);
        purchase_price      = $("#single_entry_price_"+entry_number).val();
        //alert(purchase_price);
        single_entry_total  = quantity * purchase_price;
        $("#single_entry_total_"+entry_number).html(single_entry_total);
        
        calculate_sub_total_for_purchase();

    }

    function calculate_sub_total_for_purchase()
    {
        var sub_result = 0;
        $("td[id*='single_entry_total']").each(function(){
            sub_result +=parseFloat($(this).html());
        });


        document.getElementById('sub_total').value = sub_result;
        
        calculate_grand_total();
    }

    function calculate_grand_total()
    {
        var sub_total   = document.getElementById('sub_total').value;
        
        var vat_id      = document.getElementById('vat').value;
        
        var discount    = document.getElementById('discount').value;
        
        var url=location.origin+'/purchase/'+sub_total+'/'+vat_id+'/'+discount;
        
        $.get(url,function(data){
            //alert(data);
            document.getElementById('amount').value = data;
        });
        
    }

function delete_user(row)
    {
        row.closest('tr').remove();
		calculate_sub_total_for_purchase();


    }

$(document).ready(function(){
        
        // $( ".product" ).click(function() {

        //             var account_id=$(this).data('id');

        //             var url=location.origin+'/purchase/'+account_id;

        //                 $.get(url,function(data){
                            
        //                     console.log(data);
        //                     //$('#').val(data['name']);
        //                     // $('#description').val(data['description']);
        //                     // $('#amount').val(data['amount']);
                

        //                 });
                            
        //         });


});
               
        </script>
@endsection