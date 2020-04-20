@extends('layouts.app')

@section('pageTitle')
  User Detail
@endsection

@section('content-header')
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">User Detail</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('user') }}">User</a></li>
          <li class="breadcrumb-item active">{{ $user->name }}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
<div class="row">
  <div class="col-md-7">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          General Information
        </h3>
        <div class="card-tools">
          <a href="{{ url('user/'.$user->id.'/edit') }}" class="btn btn-secondary btn-xs">
            <i class="fa fa-edit"></i> Edit
          </a>
        </div>
      </div>
      <div class="card-body">
        <strong> Name </strong>
        <p class="text-muted">
          {{ $user->name }}
        </p>

        <strong> Email </strong>
        <p class="text-muted">
          {{ $user->email }}
        </p>

        <strong> Date of Birth </strong>
        <p class="text-muted">
          {{ $user->date_of_birth }}
        </p>

        <strong> Phone Number </strong>
        <p class="text-muted">
          {{ $user->phone_number }}
        </p>

        <strong> Address </strong>
        <div class="text-muted">
          {{ $user->address }}
        </div>


      </div>
      <div class="card-footer">

      </div>
    </div>
  </div>

  <div class="col-md-5">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          Rate Information
        </h3>
        <div class="card-tools">
        </div>
      </div>
      <div class="card-body">
        @if(is_null($user->rate))
          <div class="alert alert-warning">
            This user has no rate information, please setup here
          </div>
        @else
          <strong> Daily Rate </strong>
          <p class="text-muted">
            {{ rupiah_format($user->rate->daily_rate) }}
          </p>

          <strong> Monthly Rate </strong>
          <p class="text-muted">
            {{ rupiah_format($user->rate->monthly_rate) }}
          </p>
        @endif

      </div>
      <div class="card-footer">

      </div>
    </div>
  </div>

</div>
@endsection


@section('additional_scripts')
  <script type="text/javascript">
    $(document).ready(function(){

    });
  </script>
@endsection
