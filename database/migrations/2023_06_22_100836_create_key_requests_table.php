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
        Schema::create('key_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained()->onDelete('Restrict')->onUpdate('Cascade')->references('id')->on('users');
            $table->foreignId('key_id')->constrained()->onDelete('Restrict')->onUpdate('Cascade')->references('id')->on('keys');
            $table->string('reason')->nullable();
            $table->string('ref_number')->nullable();
            $table->string('description')->nullable();
            $table->foreignId('approved_by')->constrained()->onDelete('Restrict')->onUpdate('Cascade')->references('id')->on('users');
            $table->dateTime('date_approved')->nullable();
            $table->dateTime('date_taken')->nullable();
            $table->foreignId('received_by')->constrained()->onDelete('Restrict')->onUpdate('Cascade')->references('id')->on('users');
            $table->string('comment')->nullable();
            $table->string('status')->default('Pending');
            $table->dateTime('date_returned')->nullable();
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
        Schema::dropIfExists('key_requests');
    }
};
