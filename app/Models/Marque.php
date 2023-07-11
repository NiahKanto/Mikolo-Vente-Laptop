<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    public $timestamps=false;
    protected $table='marque';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'intitule',
    ];

    public static function nouveau($data){
        $objet=new Marque();
        $objet->intitule= $data['intitule'];
        $objet->save();
    }

    public static function modifier($data){
        $objet=Marque::find($data['idMarque']);
        $objet->intitule= $data['intitule'];
        $objet->save();
    }

    public static function effacer($data){
        $objet=Marque::find($data['id']);
        $objet->delete();
    }
}
