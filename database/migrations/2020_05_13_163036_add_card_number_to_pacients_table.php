<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCardNumberToPacientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
	        $table->string('card_name', 100)->after('email')->nullable();
	        $table->unsignedBigInteger('doctor_id')->nullable();

	        $table->foreign('doctor_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('patients', function (Blueprint $table) {
		    $table->dropColumn('card_name');
		    $table->dropForeign(['doctor_id']);
		    $table->dropColumn('doctor_id');
	    });
    }
}
