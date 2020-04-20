@extends('layouts.app')

@section('pageTitle')
  Create Period
@endsection

@section('content-header')
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Create Period</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('period') }}">Period</a></li>
          <li class="breadcrumb-item active">Create</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')

  <div class="row">
    <div class="col-md-7">
      <div class="card">
        <form method="POST" action="{{ url('period') }}" class="form-horizontal" id="form-create">
        @csrf
        <div class="card-header">
          <h3 class="card-title">
            <i class="fa fa-table"></i> Form Create Period
          </h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <label for="name" class="col-md-3 col-form-label">Name</label>
            <div class="col-md-9">
              <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}">
              @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label for="start_date" class="col-md-3 col-form-label">Start Date</label>
            <div class="col-md-9">
              <input id="start_date" type="text" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" name="start_date" value="{{ old('start_date') }}">
              @if ($errors->has('start_date'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('start_date') }}</strong>
                </span>
              @endif
            </div>
          </div>
          
          <div class="form-group row">
            <label for="end_date" class="col-md-3 col-form-label">End Date</label>
            <div class="col-md-9">
              <input id="end_date" type="text" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" name="end_date" value="{{ old('end_date') }}">
              @if ($errors->has('end_date'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('end_date') }}</strong>
                </span>
              @endif
            </div>
          </div>

        </div>
        <div class="card-footer">
          <a href="{{ url('user') }}" class="btn btn-secondary">Cancel</a>
          <button id="btn-submit" type="submit" class="btn btn-success float-right">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div>

@endsection


@section('additional_scripts')
  <script type="text/javascript">
    $(document).ready(function(){

      $('#form-create').find('input[name="start_date"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: false,
        minYear: 2019,
        autoUpdateInput: false,
        locale:{
          format: "YYYY-MM-DD",
          cancelLabel: 'Clear'
        }
      }).on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      }).on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('YYYY-MM-DD'));
      });

      $('#form-create').find('input[name="end_date"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: false,
        minYear: 2019,
        autoUpdateInput: false,
        locale:{
          format: "YYYY-MM-DD",
          cancelLabel: 'Clear'
        }
      }).on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      }).on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('YYYY-MM-DD'));
      });

    });
  </script>
@endsection
