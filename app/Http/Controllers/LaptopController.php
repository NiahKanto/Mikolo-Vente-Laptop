<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laptop;
use App\Models\TransfertReference;


class LaptopController extends Controller
{
    public function nouveau(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $nouveau = $req->all();
        $data['idreference']=$nouveau['idreference'];
        $data['date']=$nouveau['date'];
        $data['qte']=$nouveau['qte'];
        Laptop::nouveau($data);
        return app()->call('App\Http\Controllers\UtilisateurController@accueilAdmin');
    }



}
