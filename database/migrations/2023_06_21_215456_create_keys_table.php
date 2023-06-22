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
        Schema::create('keys', function (Blueprint $table) {
            $table->id();
            $table->string('feeder')->constrained()->onDelete('Restrict')->onUpdate('Cascade');
            $table->foreignId('created_by')->constrained()->onDelete('Restrict')->onUpdate('Cascade')->references('id')->on('users');
            $table->string('meter_number')->nullable();
            $table->string('location')->nullable();
            $table->string('customer')->nullable();
            $table->string('account_no')->nullable();
            $table->string('padlock_no')->nullable();
            $table->string('status')->default('Available');
            $table->string('hook_no')->nullable();
            $table->string('box_no')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keys');
    }
};
