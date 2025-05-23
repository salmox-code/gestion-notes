<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'prenom', 'email', 'cne','niveau'];
    public function notes() {
        return $this->hasMany(Note::class);
    }
    public function classe() {
        return $this->belongsTo(Classe::class);
    }
    
    
}
