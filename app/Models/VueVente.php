<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VueVente extends Model
{
    public $timestamps=false;
    protected $table='vuevente';

    protected $fillable = [
        'idpointvente',
        'datevente',
        'idreference',
        'qte',
        'montant',
        'montantachat',
        'intitule',
        'mois',
        'annee',
    ];
}
