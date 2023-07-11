<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Renvoi;
use App\Models\StockPointVente;


class RenvoiController extends Controller
{
    public function nouveau(Request $req){
        if(session('utilisateur')==null){
            return view('login');
        }
        $nouveau = $req->all();
        $data['idpointvente']=$nouveau['idpointvente'];
        $data['idreference']=$nouveau['idreference'];
        $data['qte']=$nouveau['qte'];
        $data['date']=$nouveau['date'];
        $reference=StockPointVente::where('idreference','=',$nouveau['idreference'])
        ->where('idpointvente','=',$nouveau['idpointvente'])
        ->get()[0];
        $qte=$reference->getQtePV();
        if($qte>=$data['qte']){
            Renvoi::nouveau($data);
        }
        else{
            return redirect()->route('laptop')->with('erreur','Renvoi Impossible<br>A renvoyer : '.$data['qte'].'<br> Disponible : '.$qte);    
        }
        return app()->call('App\Http\Controllers\UtilisateurController@laptop');
    }

    public function reception(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $nouveau = $req->all();
        $data['idrenvoi']=$nouveau['idrenvoi'];
        $data['qte']=$nouveau['qte'];
        $data['date']=$nouveau['date'];
        Renvoi::reception($data);
        return app()->call('App\Http\Controllers\UtilisateurController@renvoiAdmin');
    }

}
