<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chambres', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->unsignedBigInteger('chambre_type_id');
            $table->boolean('disponible')->default(true);
            $table->timestamps();

            $table->foreign('chambre_type_id')->references('id')->on('chambre_types')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chambres');
    }
};
