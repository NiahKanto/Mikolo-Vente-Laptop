<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockPointVente extends Model
{
    public $timestamps=false;
    protected $table='stockpointvente';

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
        'idpointvente',
    ];

    public static function dispo($liste){
        for($i=0;$i<count($liste);$i++){
            $laptop=$liste[$i];
            $vente=VenteReference::where('idreference','=',$laptop->idreference)
            ->where('idpointvente','=',$laptop->idpointvente)
            ->get();
            $renvoi=RenvoiReferenceP::where('idreference','=',$laptop->idreference)
            ->where('idpointvente','=',$laptop->idpointvente)
            ->get();
            if(count($vente)!=0){
                $laptop->qte=$laptop->qte-$vente[0]->sum;
                $liste[$i]=$laptop;
            }
            $laptop=$liste[$i];
            if(count($renvoi)!=0){
                $laptop->qte=$laptop->qte-$renvoi[0]->sum;
                $liste[$i]=$laptop;
            }
        }
        return $liste;
    }

    public function getQtePV(){
        $vente=VenteReference::where('idreference','=',$this->idreference)
            ->where('idpointvente','=',$this->idpointvente)
            ->get();
        $renvoi=RenvoiReferenceP::where('idreference','=',$this->idreference)
            ->where('idpointvente','=',$this->idpointvente)
            ->get();
        $qte=$this->qte;
        if(count($vente)!=0){
            $qte=$qte-$vente[0]->sum;
        }
        if(count($renvoi)!=0){
            $qte=$qte-$renvoi[0]->sum;
        }
        return $qte;
    }

}
