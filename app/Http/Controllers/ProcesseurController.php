<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Processeur;


class ProcesseurController extends Controller
{
    public function nouveau(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $nouveau = $req->all();
        $data['idtypeprocesseur']=$nouveau['idtypeprocesseur'];
        $data['generation']=$nouveau['generation'];
        Processeur::nouveau($data);
        return app()->call('App\Http\Controllers\UtilisateurController@processeurAdmin');
    }

    public function delete(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $nouveau = $req->all();
        $data['id']=$nouveau['id'];
        try{
            Processeur::effacer($data);
        }
        catch(\Illuminate\Database\QueryException $exception){
            return redirect()->route('processeurAdmin')->with('erreur','Suppression Impossible<br>La suppression de ce modele de processeur peut affecter les statistiques');
        }
        return app()->call('App\Http\Controllers\UtilisateurController@processeurAdmin');
    }

}
