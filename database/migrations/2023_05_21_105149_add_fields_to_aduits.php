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
            $table->string('taken_by')->nullable();
            $table->string('service_oder_no')->nullable();
            $table->string('result')->nullable();
            $table->foreignId('issued_to')->nullable()->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->string('new_meter_no')->nullable();
            $table->date('date_issued')->nullable();
            $table->date('date_completed')->nullable();
            $table->float('energy_recovery')->default(0);
            $table->float('amount_paid')->default(0);
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
