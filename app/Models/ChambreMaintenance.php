<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChambreMaintenance extends Model
{
    use HasFactory;

    protected $table = 'chambre_maintenance'; // Spécifiez le nom exact de la table

    protected $fillable = [
        'chambre_id', 'date_debut', 'date_fin', 'description',
    ];

    public function chambre()
    {
        return $this->belongsTo(Chambre::class);
    }
}
