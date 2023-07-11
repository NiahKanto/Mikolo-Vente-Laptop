<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reception;
use App\Models\Transfert;


class ReceptionController extends Controller
{
    public function nouveau(Request $req){
        if(session('utilisateur')==null){
            return view('login');
        }
        $nouveau = $req->all();
        $data['idTransfert']=$nouveau['idTransfert'];
        $data['qte']=$nouveau['qte'];
        $data['date']=$nouveau['date'];
        $transfert=Transfert::find($nouveau['idTransfert']);
        if($transfert->qte>=$nouveau['qte']){
            Reception::nouveau($data);
        }else{
            return redirect()->route('accueil')->with('erreur','Erreur dans la reception. Veuillez verifier.<br>Recu : '.$data['qte'].'<br> Transfere : '.$transfert->qte);    
        }
        return app()->call('App\Http\Controllers\UtilisateurController@accueil');
    }

}
