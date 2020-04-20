<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollAddition extends Model
{
    protected $table = 'payroll_additions';

    protected $fillable = [
    	'payroll_id', 'name', 'amount'
    ];

    public function payroll()
    {
    	return $this->belongsTo('App\Payroll');
    }
}
