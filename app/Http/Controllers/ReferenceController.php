<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReferenceMarque;


class ReferenceController extends Controller
{
    public function nouveau(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $nouveau = $req->all();
        $data['idmarque']=$nouveau['idmarque'];
        $data['intitule']=$nouveau['intitule'];
        $data['idprocesseur']=$nouveau['idprocesseur'];
        $data['ram']=$nouveau['ram'];
        $data['ecran']=$nouveau['ecran'];
        $data['disquedur']=$nouveau['disquedur'];
        $data['prix']=$nouveau['prix'];
        $data['prixachat']=$nouveau['prixachat'];
        ReferenceMarque::nouveau($data);
        return app()->call('App\Http\Controllers\UtilisateurController@referenceAdmin');
    }

    public function delete(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $nouveau = $req->all();
        $data['id']=$nouveau['id'];
        try{
            ReferenceMarque::effacer($data);
        }
        catch(\Illuminate\Database\QueryException $exception){
            return redirect()->route('referenceAdmin')->with('erreur','Suppression Impossible<br>La suppression de cette reference de laptop peut affecter les statistiques');
        }
        return app()->call('App\Http\Controllers\UtilisateurController@referenceAdmin');
    }

}
