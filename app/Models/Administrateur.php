<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrateur extends Model
{
    public $timestamps=false;
    protected $table='administrateur';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'pseudo',
        'mdp',
    ];

    public static function login($data){
        $util1=Administrateur::where('pseudo','=',$data['pseudo'])->get();
        $util2=Administrateur::where('pseudo','=',$data['pseudo'])->where('mdp','=',$data['mdp'])->get();

        $c1=count($util1);
        $c2=count($util2);

        if($c1==0){
            return "Aucun compte n'est associe";
        }
        else{
            if($c2==0){
                return "Mot de passe incorrect";
            }
            else{
                return $util2[0];
            }
        }

    }
}
