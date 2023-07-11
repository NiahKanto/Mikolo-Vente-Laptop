<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    public $timestamps=false;
    protected $table='laptop';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'idreference',
        'qte',
        'dateachat',
    ];

    public static function nouveau($data){
        $objet=new Laptop();
        $objet->idreference= $data['idreference'];
        $objet->qte= $data['qte'];
        $objet->dateachat= $data['date'];
        $objet->save();
    }
}
