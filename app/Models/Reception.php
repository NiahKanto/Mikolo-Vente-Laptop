<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    public $timestamps=false;
    protected $table='reception';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'idtransfert',
        'qte',
        'datereception',
    ];

    public static function nouveau($data){
        $objet=new Reception();
        $objet->idtransfert= $data['idTransfert'];
        $objet->qte= $data['qte'];
        $objet->datereception= $data['date'];
        $objet->save();
    }
}
