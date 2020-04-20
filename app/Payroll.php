<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $table = 'payrolls';

    protected $fillable = [
    	'user_id', 'period_id', 'num_of_days_work', 'gross_salary',
    	'total_addition', 'total_deduction', 'net_pay'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function period()
    {
    	return $this->belongsTo('App\Period');
    }

    public function payroll_additions()
    {
    	return $this->hasMany('App\PayrollAddition');
    }

    public function payroll_deductions()
    {
    	return $this->hasMany('App\PayrollDeduction');
    }
}
