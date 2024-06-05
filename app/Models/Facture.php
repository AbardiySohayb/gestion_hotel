<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = ['reservation_id', 'date', 'invoice_number', 'customer_name', 'amount', 'status'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
