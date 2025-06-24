<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalite extends Model
{
    use HasFactory;

    protected $fillable = [
        'pret_id',
        'montant',
        'reglee',
    ];

    public function pret()
    {
        return $this->belongsTo(Pret::class);
    }
}