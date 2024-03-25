<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;
    protected $table = 'views';
    public function apartment ()
    {
        return $this -> belongsTo(Apartment::class);
    }
    public static function totalViewsForApartment($apartmentId)
    {
        return self::where('apartment_id', $apartmentId)->count();
    }
}
