<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_projects', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('jobType');
            $table->string('describtion');
            $table->string('status');
            $table->string('remarks');
            $table->unsignedBigInteger('cus_id');
            $table->unsignedBigInteger('client_id');
            $table->timestamps();
            $table->foreign('cus_id')->references('id')->on('customers');
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_projects');
    }
}
