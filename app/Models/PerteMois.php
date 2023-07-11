<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerteMois extends Model
{
    public $timestamps=false;
    protected $table='pertemois';

    protected $fillable = [
        'mois',
        'montant',
        'annee',
    ];
}
