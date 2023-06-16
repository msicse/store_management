@foreach( $products as $data ){
    <option value="{{ $data->id }}" {{ $data->id == old('product') ? 'selected' : '' }} > {{ $data->product->title  }} {{ $data->product->type == 'laptop' ? "-RSC-".$data->serial_no : "" }}</option>
@endforeach