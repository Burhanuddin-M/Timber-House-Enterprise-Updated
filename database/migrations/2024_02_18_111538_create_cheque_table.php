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
        Schema::create('cheque', function (Blueprint $table) {
            $table->id();

            $table->string('due_date')->nullable();
            $table->string('name')->nullable();
            $table->string('mobileno')->nullable();
            $table->string('figure')->nullable();
            $table->string('place')->nullable();
            $table->string('note')->nullable();
            $table->string('cheque_front')->nullable();
            $table->string('cheque_back')->nullable();
            $table->string('adhar_front')->nullable();
            $table->string('adhar_back')->nullable();
            $table->string('bill_invoice')->nullable();
            $table->string('eway_bill')->nullable();
            $table->string('status')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cheque');
    }
};
