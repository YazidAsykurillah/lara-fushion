@extends('layouts.app')

@section('pageTitle')
  User List
@endsection

@section('content-header')
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">User List</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">User</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fa fa-table"></i> User List
          </h3>
          <div class="card-tools">
            <a href="{{ url('user/create') }}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Create new user">
              Create
            </a>
          </div>
        </div>
        <div class="card-body">

          <table id="table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th style="width: 7%; text-align: center;">#</th>
                <th style="width: 15%;">Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Date Of Birth</th>
                <th>Address</th>
                <th>Role</th>
                <th style="width:10%; text-align: center;">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>

  <!--Modal Delete-->
  <div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <form method="POST" action="{{ url('user/delete') }}" class="form-horizontal" id="form-delete">
          @csrf
        <div class="modal-header">
          <h4 class="modal-title">Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>User will be deleted</p>
          <input type="text" name="id" value="">
        </div>
        <div class="modal-footer justify-content-between">
          
          <button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-outline-light btn-sm" id="btn-delete">Delete</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!--ENDModal Delete-->
@endsection


@section('additional_scripts')
  <script type="text/javascript">
    $(document).ready(function(){

      let table = $('#table').DataTable({
        processing :true,
        serverSide : true,
        ajax : '{!! url('user/datatables') !!}',
        columns :[
          {data: 'rownum', name: 'rownum', searchable:false},
          {data: 'name', name: 'name', render:function(data, type, row, meta){
            return '<a href="{{ url('user') }}/'+row.id+'">'+data+'</a>';
          }},
          {data: 'email', name: 'email'},
          {data: 'phone_number', name: 'phone_number'},
          {data: 'date_of_birth', name: 'date_of_birth'},
          {data: 'address', name: 'address'},
          {data: 'roles', name: 'roles.name', searchable:false, orderable:false},
          {data: 'action', name: 'action', searchable:false, orderable:false, className:'text-center'},
        ],
        columnDefs: [
          { className: "text-center", "targets": [ 0, 4 ] }
        ]
      });

      table.on('click', '.btn-delete', function(event){
        event.preventDefault();
        let id = $(this).attr('data-id');
        $('#form-delete').find('input[name=id]').val(id);
        $('#modal-delete').modal('show');
      });

      $('#form-delete').on('submit', function(event){
        event.preventDefault();
        $.ajax({
          method: 'POST',
          url: $(this).attr('action'),
          data: $(this).serialize(),
          beforeSend:function(){
            $('#form-delete #btn-delete').prop('disabled', true);       
          },
          success: function(response){
            console.log(response);
            if(response.status == 1){
              alertify.notify(response.message, 'success', 2, function(){
                $('#modal-delete').modal('hide');
                table.ajax.reload();
                $('#form-delete #btn-delete').prop('disabled', false);
              });
                
            } else{
              alertify.notify(response.message, 'error', 5, function(){
                $('#form-delete #btn-delete').prop('disabled', false);
              });
            }
          },
          error: function(jqXHR, textStatus, errorThrown){
            let objResponse = jqXHR.responseJSON;
            let message = objResponse.message;
            let errors = objResponse.errors;
            let error_template = message;
            
            if(errors){
              $.each( errors, function( key, value ) {
                console.log(value);
                error_template += '<li>'+ value[0] + '</li>'; //showing only the first error.
              });
            }
            alertify.notify(error_template, textStatus, 5, function(){
              console.log(errors);
              $('#form-delete #btn-delete').prop('disabled', false);
            });
              
          }
        });
      });

    });
  </script>
@endsection
