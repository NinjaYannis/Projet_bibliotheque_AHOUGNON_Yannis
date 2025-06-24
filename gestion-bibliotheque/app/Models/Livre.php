<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'auteur',
        'sujet',
        'identifiant_unique',
        'stock',
    ];
    public function prets()
    {
        return $this->hasMany(\App\Models\Pret::class);
    }
}