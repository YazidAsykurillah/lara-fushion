<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('period_id');
            $table->integer('num_of_days_work')->default(0);
            $table->decimal('gross_salary', 20, 2)->default(0);
            $table->decimal('total_addition', 20, 2)->default(0);
            $table->decimal('total_deduction', 20, 2)->default(0);
            $table->decimal('net_pay', 20, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payrolls');
    }
}
