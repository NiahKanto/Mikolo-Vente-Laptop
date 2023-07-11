<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentePointVente extends Model
{
    public $timestamps=false;
    protected $table='ventepointvente';

    protected $fillable = [
        'mois',
        'idpointvente',
        'nb',
        'montantmontant',
        'annee',
    ];

    public static function getAll($idpv,$annee){
        for($i=1;$i<=12;$i++){
            $vente=new VentePointVente();
            $vente->mois=$i;
            $vente->nb=0;
            $vente->annee=$annee;
            $vente->montantmontant=0;
            $vente->idpointvente=$idpv;
            $v=VentePointVente::where('mois','=',$i)->where('annee','=',$annee)->where('idpointvente','=',$idpv)->get();
            $montant=0;
            if(count($v)!=0){
                $vente->nb=$v[0]->nb;
                $vente->montantmontant=$v[0]->montantmontant;
            }
            $liste[$i-1]=$vente;
        }
        return $liste;
    }

    public static function getAllMois($idpv,$annee,$i){
        $vente=new VentePointVente();
        $vente->mois=$i;
        $vente->nb=0;
        $vente->idpointvente=$idpv;
        $vente->mois=$i;
        $vente->annee=$annee;
        $vente->montantmontant=0;
        $vente->montantachat=0;
        $vente->annee=$annee;
        $v=VentePointVente::where('mois','=',$i)->where('annee','=',$annee)->where('idpointvente','=',$idpv)->get();
        if(count($v)!=0){
            $vente->nb=$v[0]->nb;
            $vente->montantmontant=$v[0]->montantmontant;
            $vente->montantachat=$v[0]->montantachat;
        }
        $liste[0]=$vente;
        return $liste;
    }

    public function getBeneficeBrute(){
        return $this->montantmontant-$this->montantachat;
    }

    public function getApresPerte(){
        return $this->getBeneficeBrute()+$this->getPerte();
    }

    public function getApresCommission(){
        return $this->getApresPerte()-$this->getMontantCommission();
    }

    public function getPerte(){
        $p=PerteMoisPointVente::where('mois','=',$this->mois)->where('annee','=',$this->annee)->where('idpointvente','=',$this->idpointvente)->get();
        $valeur=0;
        if(count($p)!=0){
            $valeur=$p[0]->montant;
        }
        $p=PerteMoisRenvoiPointVente::where('mois','=',$this->mois)->where('annee','=',$this->annee)->where('idpointvente','=',$this->idpointvente)->get();
        if(count($p)!=0){
            $valeur=$valeur-$p[0]->montant;
        }
        if($valeur!=0){
            $valeur=$valeur*-1;
        }
        return $valeur;
    }

    public function getMontantCommission(){
        return Commission::getCommission($this->montantmontant);
    }

    public static function getString($liste){
        $string="";
        for($i=0;$i<count($liste);$i++){
            $string=$string.$liste[$i]->mois.";".$liste[$i]->nb.";".$liste[$i]->montantmontant.";"."|";
        }
        $val=VentePointVente::getTotal($liste[0]->idpointvente,$liste[0]->annee);
        $string=$string.";".$val[0].";".$val[1].";|";
        return $string;
    }

    public static function getTotal($idpv,$annee){
        $liste=VentePointVente::getAll($idpv,$annee);
        $val=[0,0];
        for($i=0;$i<count($liste);$i++){
            $nb=$liste[$i]->nb;
            $montant=$liste[$i]->montantmontant;
            $val[0]=$val[0]+$nb;
            $val[1]=$val[1]+$montant;
        }
        return $val;
    }

}
