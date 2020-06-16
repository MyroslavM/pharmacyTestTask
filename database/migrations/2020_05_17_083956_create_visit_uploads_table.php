<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit_uploads', function (Blueprint $table) {
            $table->bigIncrements('id');
	        $table->bigInteger('visit_id')->unsigned()->nullable();
	        $table->text('filename');
	        $table->text('filepath');
	        $table->text('original_name');
	        $table->tinyInteger('type_image');
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
        Schema::dropIfExists('visit_uploads');
    }
}
