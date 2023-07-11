<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointVente extends Model
{
    public $timestamps=false;
    protected $table='pointvente';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'lieu',
    ];

    public static function nouveau($data){
        $objet=new PointVente();
        $objet->lieu= $data['lieu'];
        $objet->save();
    }

    public static function modifier($data){
        $objet=PointVente::find($data['idPointVente']);
        $objet->lieu= $data['lieu'];
        $objet->save();
    }

    public static function effacer($data){
        $objet=PointVente::find($data['id']);
        $objet->delete();
    }

}
