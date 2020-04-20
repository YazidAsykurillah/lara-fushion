<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollDeduction extends Model
{
    protected $table = 'payroll_deductions';

    protected $fillable = [
    	'payroll_id', 'name', 'amount'
    ];

    public function payroll()
    {
    	return $this->belongsTo('App\Payroll');
    }
}
