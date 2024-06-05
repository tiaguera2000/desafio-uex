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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string("zip_code", 9);
            $table->string("city");
            $table->string("state", 2);
            $table->string("district");
            $table->string("street");
            $table->unsignedBigInteger("number");
            $table->text("complement")->nullable();
            $table->string("lat")->nullable();
            $table->string("lon")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
