<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use App\Models\ChambreMaintenance;
use App\Models\ChambreType;

class Chambre extends Model
{
    use HasFactory;

    protected $fillable = ['numero', 'chambre_type_id', 'disponible'];

    public function chambreType()
    {
        return $this->belongsTo(ChambreType::class);
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'chambre_reservation');
    }

    public function maintenances()
    {
        return $this->hasMany(ChambreMaintenance::class);
    }
}
