@extends('layouts.backend.app')

@section('title','Admin | Users')

@push('css')
	<!-- JQuery Select Css -->
    <link href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary waves-effect pull-right" style="margin-bottom:10px;" >
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
                        Add User

                    </h2>
                </div>
                <div class="body">
                    <form class="form" action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <label class="form-label">Name</label>
                                    <div class="form-line">
                                        <input type="text" value="{{ old('name') }}" id="title" name="name" class="form-control" placeholder="Enter Name" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Username</label>
                                    <div class="form-line">
                                        <input type="text" value="{{ old('username') }}" id="" name="username" class="form-control" placeholder="Enter Username" required >
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Email</label>
                                    <div class="form-line">
                                        <input type="text" value="{{ old('email') }}" id="email" name="email" class="form-control" placeholder="Enter email" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Image </label>
                                    <div class="form-line">
                                        <input type="file" value="{{ old('image') }}" id="email" name="image" class="form-control" placeholder="Enter email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Select Role</label>
                                <div class="form-group form-float">
                                    <select name="role" class="form-control show-tick" required>
                                        @foreach( $roles as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Phone</label>
                                    <div class="form-line">
                                        <input type="text" value="{{ old('phone') }}" id="phone" name="phone" class="form-control" placeholder="Enter Phone" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Password</label>
                                    <div class="form-line">
                                        <input type="password" value="{{ old('password') }}" id="password" name="password" class="form-control" placeholder="Enter Password" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">About</label>
                                    <div class="form-line">
                                        <textarea name="about" class="form-control" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <input type="submit" name="" value="Save" class="btn btn-primary btn-lg" style="padding: 12px 60px;">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->
</div>
<!-- Create Role -->
<div class="modal fade" id="craeateCategory" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.users.store')}}" method="post" enctype="multipart/form-data">
                <div class="modal-header custom-modal">
                    <h4 class="modal-title" id="defaultModalLabel">Add New Role</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" id="name" name="name" class="form-control" required>
                            <label class="form-label">Role Name</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <select name="tags[]" class="form-control">
                            @foreach( $roles as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect">Save</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category -->
<div class="modal fade" id="EditCategory" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="edit-category-form" method="post" enctype="multipart/form-data">
                <div class="modal-header custom-modal">
                    <h4 class="modal-title" id="defaultModalLabel">Edit Category</h4>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="">Category Name</label>
                            <input  type="text" id="edit_name" name="name" value="" class="form-control">

                        </div>
                    </div>
                    <div class="text-center">
                        <img id="edit_image" height="100" width="115">
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="file"  name="image" class="form-control">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect">Save Change</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- Delete Modal --}}
<div class="modal fade" id="delete-modal">
  <div class="modal-dialog">
      <form class="delete_form" method="post">
          @csrf
          @method('DELETE')
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Delete User</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <strong>Are you sure to delete this information ?</strong>
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger">Delete</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </form>
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection

@push('js')

    <script src="{{ asset('backend/js/pages/forms/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.validate.min.js') }}"></script>

<script>
$(".form").validate();
$( ".edit" ).click(function( event ) {
    var id = $(this).data('id');
    var update_url = location.origin + "/admin/categories/" + id;
    var url = location.origin + '/admin/categories/' + id + '/edit';
    $('.edit-category-form').attr('action', update_url);
    $.get(url, function (data) {
        $('#edit_name').val(data['name']);
        $('#edit_image').attr('src',location.origin + '/storage/category/' + data['image']);
    });
});
$( ".delete" ).click(function() {
    var data_id=$(this).data('delete-id');
    var url=location.origin+'/admin/roles/'+data_id;
    $('.delete_form').attr('action',url);

});

</script>


@endpush
