<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonne extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'classe',
        'email',
        'date_debut_abonnement',
        'date_fin_abonnement',
    ];

    public function penalitesNonReglees()
    {
        return Penalite::whereHas('pret', function($query) {
            $query->where('abonne_id', $this->id);
        })->where('reglee', false)->exists();
    }
    
}