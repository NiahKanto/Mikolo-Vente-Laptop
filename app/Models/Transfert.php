<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PointVente;
use App\Models\ReferenceMarque;

class Transfert extends Model
{
    public $timestamps=false;
    protected $table='transfert';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'idpointvente',
        'datetransfert',
        'idreference',
        'qte',
    ];

    public static function nouveau($data){
        $objet=new Transfert();
        $objet->idpointvente= $data['idpointvente'];
        $objet->idreference= $data['idreference'];
        $objet->qte= $data['qte'];
        $objet->datetransfert= $data['date'];
        $objet->save();
    }

    public function getPointvente(){
        $type=PointVente::where('id','=',$this->idpointvente)->get();
        return $type[0];
    }

    public function getReference(){
        $type=ReferenceMarque::where('id','=',$this->idreference)->get();
        return $type[0];
    }
}
