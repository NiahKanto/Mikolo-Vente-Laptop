<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaptopVue extends Model
{
    public $timestamps=false;
    protected $table='laptopvue';

    protected $fillable = [
        'idreference',
        'idprocesseur',
        'marque',
        'reference',
        'processeur',
        'generation',
        'ram',
        'ecran',
        'disquedur',
        'prix',
        'qte',
    ];

    public static function dispo($liste){
        for($i=0;$i<count($liste);$i++){
            $laptop=$liste[$i];
            $transfert=TransfertReference::where('idreference','=',$laptop->idreference)->get();
            $renvoi=RenvoiReference::where('idreference','=',$laptop->idreference)->get();
            if(count($transfert)!=0){
                $laptop->qte=$laptop->qte-$transfert[0]->sum;
                $liste[$i]=$laptop;
            }
            $laptop=$liste[$i];
            if(count($renvoi)!=0){
                if($renvoi[0]->recu!=null){
                    $laptop->qte=$laptop->qte+$renvoi[0]->recu;
                    $liste[$i]=$laptop;
                }
            }
        }
        return $liste;
    }

    public function getQteMagasin(){
        $transfert=TransfertReference::where('idreference','=',$this->idreference)->get();
        $renvoi=RenvoiReference::where('idreference','=',$this->idreference)->get();
        $qte=$this->qte;
        if(count($transfert)!=0){
            $qte=$qte-$transfert[0]->sum;
        }
        if(count($renvoi)!=0){
            $qte=$qte+$renvoi[0]->sum;
        }
        return $qte;
    }
}
