<?php

namespace App\Models;
use App\Models\PointVente;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    public $timestamps=false;
    protected $table='utilisateur';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'nom',
        'pseudo',
        'mdp',
        'idpointvente',
    ];

    public static function nouveau($data){
        $objet=new Utilisateur();
        $objet->nom= $data['nom'];
        $objet->pseudo= $data['pseudo'];
        $objet->mdp= $data['mdp'];
        $objet->idpointvente= $data['idpointvente'];
        $objet->save();
    }

    public static function modifier($data){
        $objet=Utilisateur::find($data['idUtilisateur']);
        $objet->idpointvente= $data['idpointvente'];
        $objet->save();
    }

    public static function effacer($data){
        $objet=Utilisateur::find($data['id']);
        $objet->delete();
    }

    public static function login($data){
        $util1=Utilisateur::where('pseudo','=',$data['pseudo'])->get();
        $util2=Utilisateur::where('pseudo','=',$data['pseudo'])->where('mdp','=',$data['mdp'])->get();

        $c1=count($util1);
        $c2=count($util2);

        if($c1==0){
            return 0;
        }
        else{
            if($c2==0){
                return -1;
            }
            else{
                return $util2[0];
            }
        }

    }

    public function getPointVente(){
        $type=PointVente::where('id','=',$this->idpointvente)->get();
        return $type[0];
    }

}
