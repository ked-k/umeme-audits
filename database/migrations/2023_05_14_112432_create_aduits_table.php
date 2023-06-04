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
        Schema::create('aduits', function (Blueprint $table) {
            $table->id();  
            $table->string('purpose')->nullable();
            $table->string('location')->nullable();
            $table->foreignId('district_id')->constrained()->onDelete('Restrict')->onUpdate('Cascade');
            $table->foreignId('zone_id')->constrained()->onDelete('Restrict')->onUpdate('Cascade');
            $table->foreignId('feeder_id')->constrained()->onDelete('Restrict')->onUpdate('Cascade');
            $table->foreignId('meter_type_id')->constrained()->onDelete('Restrict')->onUpdate('Cascade');
            $table->string('meter_number')->nullable();
            $table->string('customer')->nullable();
            $table->string('customer_contact')->nullable();
            $table->string('business_type')->nullable();
            $table->string('anomaly')->nullable();
            $table->string('customer_ref_no')->nullable();
            $table->string('supply_type')->nullable();
            $table->foreignId('created_by')->references('id')->on('users')->onDelete('Restrict')->onUpdate('Cascade');           
            $table->string('anomaly_image')->nullable();
            $table->string('clamp_on_reading')->nullable();
            $table->string('ciu_reading')->nullable();
            $table->string('average_consamption')->nullable();
            $table->string('total_consumption')->nullable();
            $table->string('test_interpretation')->nullable();
            $table->string('action_taken')->nullable();
            $table->string('reseon_left_on')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('police_letter')->nullable()->default(0);
            $table->string('police_letter_image')->nullable();
            $table->string('box_image')->nullable();
            $table->string('house_image')->nullable();
            $table->date('date_received')->nullable();
            $table->foreignId('received_by')->nullable()->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->string('receiver_action')->nullable();
            $table->string('receiver_comment')->nullable();
            $table->string('status')->default('Pending');
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
        Schema::dropIfExists('aduits');
    }
};
