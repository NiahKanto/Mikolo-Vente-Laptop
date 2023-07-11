<?php

namespace App\Models;
use App\Models\TypeProcesseur;

use Illuminate\Database\Eloquent\Model;

class Processeur extends Model
{
    public $timestamps=false;
    protected $table='processeur';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'idtypeprocesseur',
        'generation',
    ];

    public function getTypeProcesseur(){
        $type=TypeProcesseur::where('id','=',$this->idtypeprocesseur)->get();
        return $type[0];
    }

    public static function nouveau($data){
        $objet=new Processeur();
        $objet->idtypeprocesseur= $data['idtypeprocesseur'];
        $objet->generation= $data['generation'];
        $objet->save();
    }

    public function getString(){
        return $this->getTypeProcesseur()->intitule." ".$this->generation."e generation";
    }

    public static function effacer($data){
        $objet=Processeur::find($data['id']);
        $objet->delete();
    }
}
