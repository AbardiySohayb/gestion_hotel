<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date_debut', 'date_fin'];

    public function chambres()
    {
        return $this->belongsToMany(Chambre::class, 'chambre_reservation');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

