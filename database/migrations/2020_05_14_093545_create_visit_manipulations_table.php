<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitManipulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('visit_manipulations', function (Blueprint $table) {
		    $table->bigIncrements('id');
		    $table->bigInteger('visit_id')->unsigned()->nullable();
		    $table->bigInteger('manipulation_id')->unsigned()->nullable();

		    $table->foreign('visit_id')->references('id')->on('visits')->onDelete('set null');
		    $table->foreign('manipulation_id')->references('id')->on('manipulations')->onDelete('set null');
		    $table->timestamps();
	    });

	    Schema::create('visit_services', function (Blueprint $table) {
		    $table->bigIncrements('id');
		    $table->bigInteger('visit_id')->unsigned()->nullable();
		    $table->bigInteger('service_id')->unsigned()->nullable();

		    $table->foreign('visit_id')->references('id')->on('visits')->onDelete('set null');
		    $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');
		    $table->timestamps();
	    });

	    if (Schema::hasColumn('visits', 'service_id')) {
		    Schema::table('visits', function (Blueprint $table) {
			    $table->dropForeign(['service_id']);
			    $table->dropColumn('service_id');
		    });
	    }

	    if (Schema::hasColumn('visits', 'manipulation_id')) {
		    Schema::table('visits', function (Blueprint $table) {
			    $table->dropForeign(['manipulation_id']);
			    $table->dropColumn('manipulation_id');
		    });
	    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('visit_manipulations');
	    Schema::dropIfExists('visit_services');
    }
}
