<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChambreMaintenanceTable extends Migration
{
    public function up()
    {
        Schema::create('chambre_maintenance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chambre_id');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('chambre_id')->references('id')->on('chambres')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chambre_maintenance');
    }
}

