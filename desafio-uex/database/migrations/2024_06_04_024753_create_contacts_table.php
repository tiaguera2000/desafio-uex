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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            //Its not unique cuz others users may have the same contact in their account.
            $table->string("cpf", 11);
            $table->string("phone", 20)->nullable();
            $table->string("email")->unique();
            $table->unsignedBigInteger("address_id");
            $table->unsignedBigInteger("user_id");

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("address_id")->references("id")->on("addresses");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
