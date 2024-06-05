<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('chambre_reservation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chambre_id');
            $table->unsignedBigInteger('reservation_id');
            $table->timestamps();

            $table->foreign('chambre_id')->references('id')->on('chambres')->onDelete('cascade');
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chambre_reservation');
        Schema::dropIfExists('reservations');
    }
};
