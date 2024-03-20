<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $casts = [
        'date' => 'datetime', // Indica che il campo 'date' deve essere trattato come un tipo di dato data/tempo
    ];

    public function apartment ()
    {
        return $this -> belongsTo(Apartment::class);
    }
}
