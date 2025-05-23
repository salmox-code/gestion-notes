<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'niveau',
        'date',
        'heure',
        'salle_id',
        'surveillant_id'
    ];

    // ✅ Relations avec Salle et Surveillant
    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }

    public function surveillant()
    {
        return $this->belongsTo(Surveillant::class);
    }
}
