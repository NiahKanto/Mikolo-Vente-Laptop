<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transfert;
use App\Models\LaptopVue;


class TransfertController extends Controller
{
    public function nouveau(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $nouveau = $req->all();
        $data['idpointvente']=$nouveau['idpointvente'];
        $data['idreference']=$nouveau['idreference'];
        $data['qte']=$nouveau['qte'];
        $data['date']=$nouveau['date'];
        $reference=LaptopVue::where('idreference','=',$nouveau['idreference'])->get()[0];
        $qte=$reference->getQteMagasin();
        if($qte>=$data['qte']){
            Transfert::nouveau($data);
        }
        else{
            return redirect()->route('transfert')->with('erreur','Transfert Impossible<br>A transferer : '.$data['qte'].'<br> Disponible : '.$qte);    
        }
        return app()->call('App\Http\Controllers\UtilisateurController@transfertAdmin');
    }

}
