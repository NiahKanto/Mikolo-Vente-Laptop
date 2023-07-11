<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commission;
use App\Models\TypeProcesseur;


class CommissionController extends Controller
{
    public function nouveau(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $nouveau = $req->all();
        $data['min']=$nouveau['min'];
        $data['max']=$nouveau['max'];
        $data['pourcentage']=$nouveau['pourcentage'];
        Commission::nouveau($data);
        return app()->call('App\Http\Controllers\UtilisateurController@commissionAdmin');
    }

    public function delete(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $nouveau = $req->all();
        $data['id']=$nouveau['id'];
        Commission::effacer($data);
        return app()->call('App\Http\Controllers\UtilisateurController@commissionAdmin');
    }

    public function test(Request $req){
        $nouveau = $req->all();
        $data=$nouveau['nb'];
        // $obj=new TypeProcesseur();
        // $obj->intitule=$nouveau['nb'];
        // $obj->save();
        var_dump(Commission::getCommission($data));
    }

}
