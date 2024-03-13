<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sagientry', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sagi_id');
            $table->string('sr_no')->nullable;
            $table->string('date')->nullable;
            $table->string('vehicle_no')->nullable;
            $table->string('weight')->nullable;
            $table->string('rate')->nullable;
            $table->string('total')->nullable;
            $table->string('freight')->nullable;
            $table->string('grand_total')->nullable;
            $table->string('payment_given')->nullable;
            $table->string('payment_notes')->nullable;
            $table->string('total_payment_given')->nullable;
            $table->string('total_payment_received')->nullable;

            $table->foreign('sagi_id')->references('id')->on('sagi')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sagientry');
    }
};
