<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    public $timestamps=false;
    protected $table='vente';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'idpointvente',
        'datevente',
        'idreference',
        'qte',
        'supprime',
    ];

    public static function nouveau($data){
        $objet=new Vente();
        $objet->idpointvente= $data['idpointvente'];
        $objet->idreference= $data['idreference'];
        $objet->qte= $data['qte'];
        $objet->datevente= $data['date'];
        $objet->save();
    }

    public static function supprimer($data){
        $objet=Vente::find($data['id']);
        $objet->supprime=1;
        $objet->save();
    }
}
