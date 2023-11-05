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
        Schema::create('chinavisas', function (Blueprint $table) {
            $table->id();  
            $table->date('date_from');
            $table->date('date_to');
            $table->string('contact');
            $table->string('top_code');
            $table->string('code');
            $table->integer('no_days');
            $table->integer('actors');
            $table->integer('is_active')->default(1);
            $table->foreignId('users_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('chinavisas');
    }
};
