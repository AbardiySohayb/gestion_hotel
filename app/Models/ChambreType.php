<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChambreType extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'description', 'prix'];

    public function chambres()
    {
        return $this->hasMany(Chambre::class);
    }
}
