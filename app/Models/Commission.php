<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    public $timestamps=false;
    protected $table='commission';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'min',
        'max',
        'pourcentage',
    ];

    public static function nouveau($data){
        $objet=new Commission();
        $objet->min= $data['min'];
        $objet->max= $data['max'];
        $objet->pourcentage= $data['pourcentage'];
        $objet->save();
    }

    public static function effacer($data){
        $objet=Commission::find($data['id']);
        $objet->delete();
    }

    public static function getCommission($montant){
        $liste=Commission::all();
        $valeur=$montant;
        $total=0;
        if(count($liste)!=0){
            while($valeur!=0){
                for($i=0;$i<count($liste);$i++){
                    $commission=$liste[$i];
                    if($valeur>=$commission->min&&$valeur<=$commission->max){
                        if($i!=0){
                            $commissioninf=$liste[$i-1];
                            $v=$valeur-$commissioninf->max;
                            $val=($commission->pourcentage*($v))/100;
                            $total=$total+$val;
                            $valeur=$valeur-$v; 
                        }
                        else{
                            $val=($commission->pourcentage*$valeur)/100;
                            $total=$total+$val;
                            $valeur=0;
                        }
                    }
                }
            }
        }
        return $total;
    }

}
