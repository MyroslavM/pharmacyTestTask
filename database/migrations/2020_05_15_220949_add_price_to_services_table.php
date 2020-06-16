<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPriceToServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
	        $table->float('price', 8, 2)->default(0)->after('name');
        });

	    Schema::table('manipulations', function (Blueprint $table) {
		    $table->float('price', 8, 2)->default(0)->after('name');
	    });

	    Schema::table('products', function (Blueprint $table) {
		    $table->float('price', 8, 2)->default(0)->after('name');
	    });

	    Schema::table('visits', function (Blueprint $table) {
		    $table->float('cost', 8, 2)->default(0);
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
	        $table->dropColumn('price');
        });

	    Schema::table('manipulations', function (Blueprint $table) {
		    $table->dropColumn('price');
	    });

	    Schema::table('products', function (Blueprint $table) {
		    $table->dropColumn('price');
	    });

	    Schema::table('visits', function (Blueprint $table) {
		    $table->dropColumn('cost');
	    });
    }
}
