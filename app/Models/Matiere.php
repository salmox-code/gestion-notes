<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'code', 'semestre'];
    public function notes() {
        return $this->hasMany(Note::class);
    }
    public function classe() {
        return $this->belongsTo(Classe::class);
    }
    
}
