<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reservation_id',
        'invoice_pdf',
        'total_amount',
    ];

    /**
     * Get the reservation that owns the invoice.
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
