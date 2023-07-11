<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PointVente;


class PointVenteController extends Controller
{
    public function nouveau(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $nouveau = $req->all();
        $data['lieu']=$nouveau['lieu'];
        PointVente::nouveau($data);
        return app()->call('App\Http\Controllers\UtilisateurController@pointVenteAdmin');
    }

    public function modifier(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $nouveau = $req->all();
        $data['idPointVente']=$nouveau['idPointVente'];
        $data['lieu']=$nouveau['lieu'];
        PointVente::modifier($data);
        return app()->call('App\Http\Controllers\UtilisateurController@pointVenteAdmin');
    }

    public function delete(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $nouveau = $req->all();
        $data['id']=$nouveau['id'];
        try{
            PointVente::effacer($data);
        }
        catch(\Illuminate\Database\QueryException $exception){
            return redirect()->route('pointventeAdmin')->with('erreur','Suppression Impossible<br>La suppression de ce point de vente peut affecter les statistiques');
        }
        return app()->call('App\Http\Controllers\UtilisateurController@pointventeAdmin');
    }

}
