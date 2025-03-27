<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('especial_fotos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('especial_id')->constrained('especials')->onDelete('cascade');
            $table->string('foto_path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('especial_fotos');
    }
};