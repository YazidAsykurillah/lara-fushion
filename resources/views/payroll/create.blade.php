@extends('layouts.app')

@section('pageTitle')
  Create Payroll
@endsection

@section('content-header')
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Create Payroll</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('payroll') }}">Payroll</a></li>
          <li class="breadcrumb-item active">Create</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
<form method="POST" action="{{ url('payroll') }}" class="form-horizontal" id="form-create">
  @csrf
  <div class="row">
    <!--Column Primary Information-->
    <div class="col-md-5">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            Primary Information
          </h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">

          <div class="form-group row">
            <label for="period_id" class="col-md-3 col-form-label">Period</label>
            <div class="col-md-9">
              <select name="period_id" id="period_id" class="form-control {{ $errors->has('period_id') ? ' is-invalid' : '' }}"></select>
              @if ($errors->has('period_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('period_id') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label for="user_id" class="col-md-3 col-form-label">User</label>
            <div class="col-md-9">
              <select name="user_id" id="user_id" class="form-control {{ $errors->has('user_id') ? ' is-invalid' : '' }}"></select>
              @if ($errors->has('user_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('user_id') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label for="num_of_days_work" class="col-md-3 col-form-label">Work Days</label>
            <div class="col-md-9">
              <input type="text" name="num_of_days_work" id="num_of_days_work" class="form-control" value="0">
              @if ($errors->has('num_of_days_work'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('num_of_days_work') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label for="daily_rate" class="col-md-3 col-form-label">Daily Rate</label>
            <div class="col-md-9">
              <input type="text" name="daily_rate" id="daily_rate" class="form-control" readonly>
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
              <input type="text" name="monthly_rate" id="monthly_rate" class="form-control" readonly>
              @if ($errors->has('monthly_rate'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('monthly_rate') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label for="gross_salary" class="col-md-3 col-form-label">Gross Salary</label>
            <div class="col-md-9">
              <input type="text" name="gross_salary" id="gross_salary" class="form-control" readonly="readonly">
              @if ($errors->has('gross_salary'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('gross_salary') }}</strong>
                </span>
              @endif
            </div>
          </div>

        </div>
      </div>
    </div>
    <!--ENDColumn Primary Information-->

    <!--Column Salary Information-->
    <div class="col-md-7">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            Additions
          </h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <table class="table" id="table-payroll-additions">
            <thead>
              <tr>
                <th style="width: 60%;">Name</th>
                <th>Amount</th>
                <th>
                  <button type="button" id="btn-add-payroll-additions" class="btn btn-info btn-xs">
                    <i class="fa fa-plus-circle"></i>
                  </button>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <input type="text" name="addition_name[]"  class="form-control" required="required">
                </td>
                <td>
                  <input type="text" name="addition_amount[]"  class="form-control addition_amount" required="required">
                </td>
                <td>
                  <button type="button" class="btn btn-danger btn-xs">
                    <i class="fa fa-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td style="text-align: right;">
                  <strong>Total</strong>
                </td>
                <td>
                  <input type="text" name="total_addition" id="total_addition"  class="form-control" value="0" readonly>
                </td>
                <td></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            Deductions
          </h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <table class="table" id="table-payroll-deductions">
            <thead>
              <tr>
                <th style="width: 60%;">Name</th>
                <th>Amount</th>
                <th>
                  <button type="button" id="btn-add-payroll-deductions" class="btn btn-info btn-xs">
                    <i class="fa fa-plus-circle"></i>
                  </button>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <input type="text" name="deduction_name[]"  class="form-control" required="required">
                </td>
                <td>
                  <input type="text" name="deduction_amount[]"  class="form-control deduction_amount" required="required">
                </td>
                <td>
                  <button type="button" class="btn btn-danger btn-xs">
                    <i class="fa fa-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td style="text-align: right;">
                  <strong>Total</strong>
                </td>
                <td>
                  <input type="text" name="total_deduction" id="total_deduction"  class="form-control" value="0" readonly>
                </td>
                <td></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>

      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">
            Payroll Information
          </h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <table class="table">
            <tbody>
              <tr>
                <td style="width: 50%;">Gross Salary</td>
                <td style="width: 10%;">:</td>
                <td>
                  <input type="text" name="gross_salary_info" id="gross_salary_info"  class="form-control" value="0" readonly>
                </td>
              </tr>
              <tr>
                <td style="width: 50%;">Total Addition</td>
                <td style="width: 10%;">:</td>
                <td>
                  <input type="text" name="total_addition_info" id="total_addition_info"  class="form-control" value="0" readonly>
                </td>
              </tr>
              <tr>
                <td style="width: 50%;">Total Deduction</td>
                <td style="width: 10%;">:</td>
                <td>
                  <input type="text" name="total_deduction_info" id="total_deduction_info"  class="form-control" value="0" readonly>
                </td>
              </tr>
              <tr>
                <td style="width: 50%;">Net Pay</td>
                <td style="width: 10%;">:</td>
                <td>
                  <input type="text" name="net_pay" id="net_pay"  class="form-control" value="0" readonly>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
    <!--ENDColumn Salary Information-->

  </div>

  <div class="row">
    <div class="col-md-12">
      <a href="{{ url('payroll') }}" class="btn btn-secondary">Cancel</a>
      <button id="btn-submit" type="submit" class="btn btn-success float-right">Save</button>
    </div>
  </div>
</form>
<br>
@endsection


@section('additional_scripts')
  <script type="text/javascript">
    $(document).ready(function(){

      $('#form-create #daily_rate').autoNumeric('init',{
        aSep:'.',
        aDec:',',
        mDec:'0',
        vMin:'0'
      });

      $('#form-create #num_of_days_work').autoNumeric('init',{
        aSep:'.',
        aDec:',',
        mDec:'0',
      });

      $('#form-create #monthly_rate').autoNumeric('init',{
        aSep:'.',
        aDec:',',
        mDec:'0',
      });

      $('#form-create #gross_salary').autoNumeric('init',{
        aSep:'.',
        aDec:',',
        mDec:'0',
      });

      $('#form-create .addition_amount').autoNumeric('init',{
        aSep:'.',
        aDec:',',
        mDec:'0',
      });

      $('#form-create #total_addition').autoNumeric('init',{
        aSep:'.',
        aDec:',',
        mDec:'0',
      });

      $('#form-create .deduction_amount').autoNumeric('init',{
        aSep:'.',
        aDec:',',
        mDec:'0',
      });

      $('#form-create #total_deduction').autoNumeric('init',{
        aSep:'.',
        aDec:',',
        mDec:'0',
      });

      $('#form-create #gross_salary_info').autoNumeric('init',{
        aSep:'.',
        aDec:',',
        mDec:'0',
      });

      $('#form-create #total_addition_info').autoNumeric('init',{
        aSep:'.',
        aDec:',',
        mDec:'0',
      });

      $('#form-create #total_deduction_info').autoNumeric('init',{
        aSep:'.',
        aDec:',',
        mDec:'0',
      });

      $('#form-create #net_pay').autoNumeric('init',{
        aSep:'.',
        aDec:',',
        mDec:'0',
      });

      //Select Period id
      $('#period_id').select2({
        theme: 'bootstrap4',
        placeholder: '----Select----',
        ajax: {
          url: '{!! url('payroll/select2Period') !!}',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                return {
                  text: item.name,
                  id: item.id,
                }
              })
            };
          },
          cache: true
        },
        allowClear : true,
      }).on('select2:select', function(){
        $('#user_id').val('').trigger('change.select2');
      }).on('select2:clear', function(){
        $('#user_id').val('').trigger('change.select2');
      });
      //ENDSelect Period id

      //Select User Id
      $('#user_id').select2({
        theme: 'bootstrap4',
        placeholder: '----Select----',
        ajax: {
          url: '{!! url('payroll/select2User') !!}',
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              q: params.term, // search term
              page: params.page,
              period_id : $('#period_id').val()
            };
          },
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                return {
                  text: item.name,
                  id: item.id,
                  daily_rate : item.rate.daily_rate,
                  monthly_rate : item.rate.monthly_rate,
                }
              })
            };
          },
          cache: true
        },
        allowClear : true,
      }).on('select2:select', function(){
        let selected_user = $('#user_id').select2('data')[0];
        $('#form-create #daily_rate').autoNumeric('set',selected_user.daily_rate);
        $('#form-create #monthly_rate').autoNumeric('set',selected_user.monthly_rate);
        set_gross_salary_value();
        
      }).on('select2:clear', function(){
        $('#form-create #daily_rate').autoNumeric('set',0);
        $('#form-create #monthly_rate').autoNumeric('set',0);
        set_gross_salary_value();
        
      }).on('select2:change', function(){
        $('#form-create #daily_rate').autoNumeric('set',0);
        $('#form-create #monthly_rate').autoNumeric('set',0);
        set_gross_salary_value();
        
      });
      //ENDSelect User Id

      $('#num_of_days_work').keyup(function(){
        set_gross_salary_value();
      });

      $('.addition_amount').keyup(function(){
        set_total_addition_value();
      });

      $('.deduction_amount').keyup(function(){
        set_total_deduction_value();
      });

      //GETTER input value functions
        //num_of_days_work
        function get_num_of_days_work_value(){
          let result = $('#num_of_days_work').autoNumeric('get');
          return Number(result);
        }

        //daily_rate
        function get_daily_rate_value(){
          let result = $('#daily_rate').autoNumeric('get');
          return Number(result);
        }

        //monthly_rate
        function get_monthly_rate_value(){
          let result = $('#monthly_rate').autoNumeric('get');
          return Number(result);
        }

        //gross rate
        function get_gross_salary_value(){
          let result = $('#gross_salary').autoNumeric('get');
          return Number(result);
        }

        //get sum of value from ADDITION amount class inputs
        function get_addition_amount_summary(){
          let result = 0;
          $('.addition_amount').each(function(){
            result+=Number($(this).autoNumeric('get'));
          });
          return Number(result);
        }

        //get sum of value from DEDUCTION amount class inputs
        function get_deduction_amount_summary(){
          let result = 0;
          $('.deduction_amount').each(function(){
            result+=Number($(this).autoNumeric('get'));
          });
          return Number(result);
        }


      //ENDGETTER input value functions

      //SETTER input value functions
        function set_gross_salary_value(){
          let num_of_days_work_value = get_num_of_days_work_value();
          let daily_rate_value = get_daily_rate_value();
          let monthly_rate_value = get_monthly_rate_value();
          let result = (num_of_days_work_value * daily_rate_value)+monthly_rate_value;
          console.log(num_of_days_work_value);
          $('#gross_salary').autoNumeric('set', result);
          $('#gross_salary_info').autoNumeric('set', result);
          set_net_pay_value();
        }

        function set_total_addition_value(){
          let result = get_addition_amount_summary();
          $('#total_addition').autoNumeric('set', result);
          $('#total_addition_info').autoNumeric('set', result);
          set_net_pay_value();
        }

        function set_total_deduction_value(){
          let result = get_deduction_amount_summary();
          $('#total_deduction').autoNumeric('set', result);
          $('#total_deduction_info').autoNumeric('set', result);
          set_net_pay_value();
        }

        function set_net_pay_value(){
          let result = 0;
          let gross_salary = get_gross_salary_value();
          let addition_amount_summary = get_addition_amount_summary();
          let deduction_amount_summary = get_deduction_amount_summary();
              result = gross_salary+addition_amount_summary-deduction_amount_summary;
              $('#net_pay').autoNumeric('set', result);
        }
      //ENDSETTER input value functions

    });
  </script>
@endsection
