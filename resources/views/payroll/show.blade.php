@extends('layouts.app')

@section('pageTitle')
  Payroll Detail
@endsection

@section('content-header')
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Payroll Detail</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('payroll') }}">Payroll</a></li>
          <li class="breadcrumb-item active">Show</li>
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
          Payroll Detail
        </h3>
        <div class="card-tools">
          <a href="{{ url('payroll/'.$payroll->id.'/print_pdf') }}" class="btn btn-xs btn-default" data-toggle="tooltip" title="Print PDF">
            <i class="fa fa-print"></i> Print
          </a>
        </div>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table">
                <tbody>
                  <tr>
                    <td style="width: 20%;">User</td>
                    <td style="width: 5%;">:</td>
                    <td style="">{{ $payroll->user->name }}</td>
                  </tr>
                  <tr>
                    <td style="width: 20%;">Period</td>
                    <td style="width: 5%;">:</td>
                    <td style="">{{ $payroll->period->name }}</td>
                  </tr>
                  <tr>
                    <td style="width: 20%;">Work Days</td>
                    <td style="width: 5%;">:</td>
                    <td style="">{{ $payroll->num_of_days_work }}</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="table-responsive">
              <table class="table">
                <tbody>
                  <tr>
                    <td style="width: 70%;">Gross Salary</td>
                    <td style="">{{ rupiah_format($payroll->gross_salary) }}</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <p class="lead">Additions:</p>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 70%;">Name</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Overtime Bonus</td>
                    <td>500.000</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <td style="text-align: right;">Total</td>
                    <td>500.000</td>
                  </tr>
                </tfoot>
              </table>
            </div>

            <p class="lead">Deductions:</p>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 70%;">Name</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Cash Advance</td>
                    <td>100.000</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <td style="text-align: right;">Total</td>
                    <td>100.000</td>
                  </tr>
                </tfoot>
              </table>
            </div>

            <div class="table-responsive">
              <table class="table">
                <tbody>
                  <tr>
                    <td style="width: 70%;">Net Pay</td>
                    <td>{{ rupiah_format($payroll->net_pay) }}</td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
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
