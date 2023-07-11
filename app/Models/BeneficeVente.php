<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficeVente extends Model
{
    public $timestamps=false;
    protected $table='beneficevente';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'idpointvente',
        'datevente',
        'idreference',
        'qte',
        'montant',
    ];

    public static function nouveau($data){
        $objet=new Vente();
        $objet->idpointvente= $data['idpointvente'];
        $objet->idreference= $data['idreference'];
        $objet->qte= $data['qte'];
        $objet->datevente= $data['date'];
        $objet->save();
    }
}
