<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Marque;
use App\Models\Processeur;
use App\Models\TransfertReference;
use App\Models\RenvoiReference;

class ReferenceMarque extends Model
{
    public $timestamps=false;
    protected $table='referencemarque';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'idmarque',
        'intitule',
        'idprocesseur',
        'ram',
        'ecran',
        'disquedur',
        'prix',
        'prixachat',
    ];

    public static function nouveau($data){
        $objet=new ReferenceMarque();
        $objet->idmarque= $data['idmarque'];
        $objet->intitule= $data['intitule'];
        $objet->idprocesseur= $data['idprocesseur'];
        $objet->ram= $data['ram'];
        $objet->ecran= $data['ecran'];
        $objet->disquedur= $data['disquedur'];
        $objet->prix= $data['prix'];
        $objet->prixachat= $data['prixachat'];
        $objet->save();
    }

    public static function effacer($data){
        $objet=ReferenceMarque::find($data['id']);
        $objet->delete();
    }

    public function getMarque(){
        $type=Marque::where('id','=',$this->idmarque)->get();
        return $type[0];
    }

    public function getProcesseur(){
        $type=Processeur::where('id','=',$this->idprocesseur)->get();
        return $type[0];
    }

    public function getString(){
        $proc=$this->getProcesseur();
        return $proc->getTypeProcesseur()->intitule." ".$proc->generation."e generation";
    }


}
