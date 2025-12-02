<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'date', 'ticket_price', 'image_path', 'venue_id'];

    protected $casts = [
        'date' => 'date',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}