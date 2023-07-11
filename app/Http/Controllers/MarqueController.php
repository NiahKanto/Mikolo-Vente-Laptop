<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marque;


class MarqueController extends Controller
{
    public function nouveau(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $nouveau = $req->all();
        $data['intitule']=$nouveau['intitule'];
        Marque::nouveau($data);
        return app()->call('App\Http\Controllers\UtilisateurController@marqueAdmin');
    }

    public function modifier(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $nouveau = $req->all();
        $data['idMarque']=$nouveau['idMarque'];
        $data['intitule']=$nouveau['intitule'];
        Marque::modifier($data);
        return app()->call('App\Http\Controllers\UtilisateurController@marqueAdmin');
    }

    public function delete(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $nouveau = $req->all();
        $data['id']=$nouveau['id'];
        try{
            Marque::effacer($data);
        }
        catch(\Illuminate\Database\QueryException $exception){
            return redirect()->route('marqueAdmin')->with('erreur','Suppression Impossible<br>La suppression de cette marque peut affecter les statistiques');
        }
        return app()->call('App\Http\Controllers\UtilisateurController@marqueAdmin');
    }

}
