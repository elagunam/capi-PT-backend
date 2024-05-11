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
        Schema::create('contact_phones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_id');
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->string('phone_number', 25);
            $table->string('type', 10);
            $table->timestamps();
            $table->boolean('deleted')->default(false);
            $table->timestamp('deleted_at')->nullable();
        });
    }
            

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_phones');
    }
};
