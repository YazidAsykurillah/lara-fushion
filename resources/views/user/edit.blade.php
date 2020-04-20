@extends('layouts.app')

@section('pageTitle')
  Edit User
@endsection

@section('content-header')
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit User</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('user') }}">User</a></li>
          <li class="breadcrumb-item"><a href="{{ url('user/'.$user->id) }}">{{ $user->name }} </a></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
<form method="POST" action="{{ url('user/'.$user->id) }}" class="form-horizontal" id="form-create">
  @csrf
  @method('PUT')
  <div class="row">
    <!--Column General Information-->
    <div class="col-md-7">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            General Information
          </h3>
          <div class="card-tools">
          </div>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <label for="name" class="col-md-3 col-form-label">Name</label>
            <div class="col-md-9">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name')?? $user->name }}">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
          </div>
          <div class="form-group row">
            <label for="email" class="col-md-3 col-form-label">Email</label>
            <div class="col-md-9">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') ?? $user->email }}">
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
          </div>

          <div class="form-group row">
            <label for="date_of_birth" class="col-md-3 col-form-label">Date of Birth</label>
            <div class="col-md-9">
                <input id="date_of_birth" type="text" class="form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" name="date_of_birth" value="{{ old('date_of_birth') ?? $user->date_of_birth }}">
                @if ($errors->has('date_of_birth'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                    </span>
                @endif
            </div>
          </div>

          <div class="form-group row">
            <label for="phone_number" class="col-md-3 col-form-label">Phone Number</label>
            <div class="col-md-9">
                <input id="phone_number" type="text" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') ?? $user->phone_number }}">
                @if ($errors->has('phone_number'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone_number') }}</strong>
                    </span>
                @endif
            </div>
          </div>

          <div class="form-group row">
            <label for="address" class="col-md-3 col-form-label">Address</label>
            <div class="col-md-9">
                <textarea id="address" name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}">{{ old('address') ?? $user->address }}</textarea>
                @if ($errors->has('address'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>
          </div>

          <div class="form-group row">
            <label for="role_id" class="col-md-3 col-form-label">Role</label>
            <div class="col-md-9">
              <select name="role_id" id="role_id" class="form-control {{ $errors->has('role_id') ? ' is-invalid' : '' }}">
                <option value="{{old('role_id') ? old('role_id') : '' }}">
                  {{old('role_id') ? \App\Role::find(old('role_id'))->name : '---Select Role---'}}
                </option>
                @if($roles->count())
                  @foreach($roles as $role)
                  <option value="{{ $role->id}}" {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }}>{{$role->name}}</option>
                  @endforeach
                @endif
              </select>
              @if ($errors->has('role_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('role_id') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--ENDColumn General Information-->

    <!--Column Rate Information-->
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
          <div class="form-group row">
            <label for="daily_rate" class="col-md-3 col-form-label">Daily Rate</label>
            <div class="col-md-9">
                <input id="daily_rate" type="text" class="form-control{{ $errors->has('daily_rate') ? ' is-invalid' : '' }}" name="daily_rate" value="{{ old('daily_rate') ?? $user->rate ? $user->rate->daily_rate : '0' }} ">
                @if ($errors->has('daily_rate'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('daily_rate') }}</strong>
                    </span>
                @endif
            </div>
          </div>
          <div class="form-group row">
            <label for="monthly_rate" class="col-md-3 col-form-label">Monthly Rate</label>
            <div class="col-md-9">
                <input id="monthly_rate" type="text" class="form-control{{ $errors->has('monthly_rate') ? ' is-invalid' : '' }}" name="monthly_rate" value="{{ old('monthly_rate') ?? $user->rate ? $user->rate->monthly_rate : '0' }}">
                @if ($errors->has('monthly_rate'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('monthly_rate') }}</strong>
                    </span>
                @endif
            </div>
          </div>
        </div>
      </div>

    </div>
    <!--ENDColumn Rate Information-->
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <a href="{{ url('user') }}" class="btn btn-secondary">Cancel</a>
          <button id="btn-submit" type="submit" class="btn btn-success float-right">Save</button>    
        </div>
    </div>
    </div>
  </div>

</form>
@endsection


@section('additional_scripts')
  <script type="text/javascript">
    $(document).ready(function(){


      $('#form-create').find('input[name="date_of_birth"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1980,
        locale:{
          "format": "DD-MM-YYYY",
        }
      });

      $('#form-create #daily_rate').autoNumeric('init',{
        aSep:'.',
        aDec:',',
        mDec:'0',
      });

      $('#form-create #monthly_rate').autoNumeric('init',{
        aSep:'.',
        aDec:',',
        mDec:'0',
      });

      //Form Submission handling
      $('#form-create').on('submit', function(event){
        $('#btn-submit').prop('disabled', true);
      })


    });
  </script>
@endsection
