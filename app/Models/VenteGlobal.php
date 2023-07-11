<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VenteGlobal extends Model
{
    public $timestamps=false;
    protected $table='venteglobal';

    protected $fillable = [
        'mois',
        'nb',
        'montant',
        'annee',
        'montantachat'
    ];

    public static function getAll($annee){
        for($i=1;$i<=12;$i++){
            $vente=new VenteGlobal();
            $vente->mois=$i;
            $vente->nb=0;
            $vente->montant=0;
            $vente->montantachat=0;
            $vente->mois=$i;
            $vente->annee=$annee;
            $v=VenteGlobal::where('mois','=',$i)->where('annee','=',$annee)->get();
            if(count($v)!=0){
                $vente->nb=$v[0]->nb;
                $vente->montant=$v[0]->montant;
                $vente->montantachat=$v[0]->montantachat;
            }
            $liste[$i-1]=$vente;
        }
        return $liste;
    }

    public function getBeneficeBrute(){
        return $this->montant-$this->montantachat;
    }

    public function getApresPerte(){
        return $this->getBeneficeBrute()+$this->getPerte();
    }

    public function getApresCommission(){
        return $this->getApresPerte()-$this->getMontantCommission();
    }

    public function getPerte(){
        $valeur=0;
        $p=PerteMois::where('mois','=',$this->mois)->where('annee','=',$this->annee)->get();
        if(count($p)!=0){
            $valeur=$valeur-$p[0]->montant;
        }
        $p=PerteMoisRenvoi::where('mois','=',$this->mois)->where('annee','=',$this->annee)->get();
        if(count($p)!=0){
            $valeur=$valeur-$p[0]->montant;
        }
        return $valeur;
    }

    public function getCouleur(){
        $val="";
        if($this->montant>=0&&$this->montant<2000000){
            $val= "orange";
        }
        if($this->montant>=2000000&&$this->montant<50000000){
            $val= "green";
        }
        if($this->montant>=50000000){
            $val= "blue";
        }
        return $val;
    }

    public function getMontantCommission(){
        return Commission::getCommission($this->montant);
    }

    public static function getTotal($annee){
        $liste=VenteGlobal::getAll($annee);
        $val=[0,0,0,0,0,0,0,0];
        for($i=0;$i<count($liste);$i++){
            $nb=$liste[$i]->nb;
            $montant=$liste[$i]->montant;
            $achat=$liste[$i]->montantachat;
            $benefice=$liste[$i]->getBeneficeBrute();
            $perte=$liste[$i]->getPerte();
            $beneficeperte=$liste[$i]->getApresPerte();
            $commission=$liste[$i]->getMontantCommission();
            $beneficecommission=$liste[$i]->getApresCommission();
            $val[0]=$val[0]+$nb;
            $val[1]=$val[1]+$montant;
            $val[2]=$val[2]+$achat;
            $val[3]=$val[3]+$benefice;
            $val[4]=$val[4]+$perte;
            $val[5]=$val[5]+$beneficeperte;
            $val[6]=$val[6]+$commission;
            $val[7]=$val[7]+$beneficecommission;
        }
        return $val;
    }

    public static function getString($liste){
        $string="";
        for($i=0;$i<count($liste);$i++){
            $string=$string.$liste[$i]->mois.";".$liste[$i]->nb.";".$liste[$i]->montant.";".$liste[$i]->montantachat.";"
            .$liste[$i]->getBeneficeBrute().";".$liste[$i]->getPerte().";".$liste[$i]->getApresPerte().";".
            $liste[$i]->getMontantCommission().";".$liste[$i]->getApresCommission().";".$liste[$i]->annee.";|";
        }
        $val=VenteGlobal::getTotal($liste[0]->annee);
        $string=$string.";".$val[0].";".$val[1].";".$val[2].";"
        .$val[3].";".$val[4].";".$val[5].";".
        $val[6].";".$val[7].";".";|";
        return $string;
    }


}
