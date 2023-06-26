<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aduits', function (Blueprint $table) {
          $table->string('form_image')->nullable()->after('box_image');
          $table->string('cordinates')->nullable();
          $table->string('latitude')->nullable();
          $table->string('longitude')->nullable();
          $table->string('city')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aduits', function (Blueprint $table) {
            //
        });
    }
};
