<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerteMoisRenvoi extends Model
{
    public $timestamps=false;
    protected $table='pertemoisrenvoi';

    protected $fillable = [
        'mois',
        'montant',
        'annee',
    ];
}
