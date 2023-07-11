<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerteMoisRenvoiPointVente extends Model
{
    public $timestamps=false;
    protected $table='pertemoisrenvoipointvente';

    protected $fillable = [
        'mois',
        'montant',
        'annee',
        'idpointvente',
    ];
}
