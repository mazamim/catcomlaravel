<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatechildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratechildren', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rate_id')->unsigned();
            $table->bigInteger('project_id')->unsigned();
            $table->string('sor');
            $table->string('description');
            $table->string('uom');
            $table->decimal('rate');
            $table->bigInteger('qty');
            $table->timestamps();
            $table->foreign('rate_id')->references('id')->on('rate_cards');
            $table->foreign('project_id')->references('id')->on('my_projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratechildren');
    }
}
