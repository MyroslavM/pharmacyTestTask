<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('visit_cost', function (Blueprint $table) {
		    $table->bigIncrements('id');
		    $table->bigInteger('visit_id')->unsigned()->nullable();
		    $table->float('price', 8, 2);
		    $table->string('name');
		    $table->string('model_type');
		    $table->integer('model_id');
		    $table->timestamps();

		    $table->foreign('visit_id')->references('id')->on('visits')->onDelete('set null');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('visit_cost');
    }
}
