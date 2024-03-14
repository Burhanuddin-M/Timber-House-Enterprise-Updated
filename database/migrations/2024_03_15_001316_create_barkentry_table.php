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
        Schema::create('barkentry', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bark_id');
            $table->enum('type', ['long', 'short'])->nullable();
            $table->string('quantity')->nullable();
            $table->string('rate')->nullable();
            $table->string('total')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        
            $table->foreign('bark_id')->references('id')->on('bark')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barkentry');
    }
};
