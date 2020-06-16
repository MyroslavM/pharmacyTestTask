<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('clinic_id')->unsigned()->after('id')->nullable();
            $table->string('surname')->nullable()->after('name');
            $table->string('patronymic')->nullable()->after('name');
            $table->string('address')->nullable()->after('patronymic');
            $table->string('phone')->nullable()->after('address');
            $table->string('experience')->nullable()->after('patronymic');
            $table->string('specialization')->nullable()->after('patronymic');
            $table->string('degree')->nullable()->after('patronymic');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
