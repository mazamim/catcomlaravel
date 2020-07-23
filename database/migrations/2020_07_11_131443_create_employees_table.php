<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('emp_name');
            $table->string('lastname');
            $table->string('position');
            $table->string('mobile');
            $table->string('emailadd');
            $table->text('description')->nullable();
            $table->text('skills')->nullable();
            $table->string('address')->nullable();
            $table->string('salarytype')->nullable();
            $table->float('salary')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('bankdetails')->nullable();
            $table->string('Status')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
