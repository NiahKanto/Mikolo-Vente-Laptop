<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerteMoisPointVente extends Model
{
    public $timestamps=false;
    protected $table='pertemoispointvente';

    protected $fillable = [
        'mois',
        'montant',
        'annee',
        'idpointvente',
    ];
}
