<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renvoi extends Model
{
    public $timestamps=false;
    protected $table='renvoi';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'idpointvente',
        'daterenvoi',
        'idreference',
        'qte',
        'qterecu',
        'datereception',
    ];

    public static function nouveau($data){
        $objet=new Renvoi();
        $objet->idpointvente= $data['idpointvente'];
        $objet->idreference= $data['idreference'];
        $objet->qte= $data['qte'];
        $objet->daterenvoi= $data['date'];
        $objet->save();
    }

    public static function reception($data){
        $objet=Renvoi::find($data['idrenvoi']);
        $objet->qterecu= $data['qte'];
        $objet->datereception= $data['date'];
        $objet->save();
    }
}
