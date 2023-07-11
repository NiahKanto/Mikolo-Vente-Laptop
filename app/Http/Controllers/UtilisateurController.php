<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Administrateur;
use App\Models\LaptopVue;
use App\Models\PointVente;
use App\Models\ReferenceMarque;
use App\Models\Marque;
use App\Models\Processeur;
use App\Models\Transfert;
use App\Models\TypeProcesseur;
use App\Models\StockPointVente;
use App\Models\VenteGlobal;
use App\Models\VentePointVente;
use App\Models\BeneficeVente;
use App\Models\Renvoi;
use App\Models\Commission;
use App\Models\VueVente;


class UtilisateurController extends Controller
{
    public function nouveau(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $nouveau = $req->all();
        $data['nom']=$nouveau['nom'];
        $data['pseudo']=$nouveau['pseudo'];
        $data['mdp']=$nouveau['mdp'];
        $data['idpointvente']=$nouveau['idpointvente'];
        Utilisateur::nouveau($data);
        return app()->call('App\Http\Controllers\UtilisateurController@utilisateurAdmin');
    }

    public function modifier(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $nouveau = $req->all();
        $data['idpointvente']=$nouveau['idpointvente'];
        $data['idUtilisateur']=$nouveau['idUtilisateur'];
        Utilisateur::modifier($data);
        return app()->call('App\Http\Controllers\UtilisateurController@utilisateurAdmin');
    }

    public function delete(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $nouveau = $req->all();
        $data['id']=$nouveau['id'];
        Utilisateur::effacer($data);
        return app()->call('App\Http\Controllers\UtilisateurController@utilisateurAdmin');
    }

    public function login(Request $req){
        $nouveau = $req->all();
        $data['pseudo']=$nouveau['pseudo'];
        $data['mdp']=$nouveau['mdp'];
        $util=Utilisateur::login($data);
        if($util instanceof Utilisateur){
            session()->put('utilisateur',$util);
            return app()->call('App\Http\Controllers\UtilisateurController@accueil');
        }
        else{
            if($util==0){
                $mess['erreur']="Aucun compte n'est associe";
            }
            else if($util==-1){
                $mess['erreur']="Mot de passe incorrect";
            }
            return view('login')->with('data',$mess);
        }
    }

    public function loginService($peusdo,$mdp){
        $data['pseudo']=$peusdo;
        $data['mdp']=$mdp;
        $util=Utilisateur::login($data);
        if($util instanceof Utilisateur){
           return $util->id;
        }
        else{
            return $util;
        }
    }

    public function accueil(){
        if(session('utilisateur')==null){
            return view('login');
        }
        $util=session('utilisateur');
        $mess['transfert']=Transfert::where('idpointvente','=',$util->idpointvente)
        ->whereNotIn('id',
        function($query){$query->select('idtransfert')->from('reception');}
        )
        ->get();
        $mess['erreur']=session('erreur');
        return view('home')->with('data',$mess);
    }

    public function laptop(){
        if(session('utilisateur')==null){
            return view('login');
        }
        $util=session('utilisateur');
        $laptop=StockPointVente::where('idpointvente','=',$util->idpointvente)
        ->get();
        $mess['laptop']=StockPointVente::dispo($laptop);
        $mess['ref']=ReferenceMarque::all();
        $mess['erreur']=session('erreur');
        return view('laptop')->with('data',$mess);
    }

    public function listeVente(Request $req){
        if(session('utilisateur')==null){
            return view('login');
        }
        $util=session('utilisateur');
        $o=BeneficeVente::where('idpointvente','=',$util->idpointvente)
        ->get();
        $data=$req->all();
        if(isset($data['idreference'])){
            $reference=$data['idreference'];
            $prixmin=$data['prixmin'];
            $prixmax=$data['prixmax'];
            $o=BeneficeVente::where('idpointvente','=',$util->idpointvente);
            if($reference!=0){
                $o=$o->where('idreference','=',$reference);
            }
            if(strcmp('',$prixmin)!=0){
                $o=$o->where('montant','>=',$prixmin);
            }
            if(strcmp('',$prixmax)!=0){
                $o=$o->where('montant','<=',$prixmax);
            }
            $o=$o->get();
        }
        $mess['vente']=$o;
        $mess['reference']=ReferenceMarque::all();
        return view('listevente')->with('data',$mess);
    }

    public function loginAdmin(Request $req){
        $nouveau = $req->all();
        $data['pseudo']=$nouveau['pseudo'];
        $data['mdp']=$nouveau['mdp'];
        $admin=Administrateur::login($data);
        session()->put('admin',$admin);
        return app()->call('App\Http\Controllers\UtilisateurController@accueilAdmin');
    }

    public function accueilAdmin(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $data=$req->all();
        $laptop=LaptopVue::where('marque','like','%%')->paginate(3);
        if(isset($data['marqueid'])){
            $marque=$data['marqueid'];
            $valeur=$data['valeur'];
            if($marque!=0){
                if(strcmp($valeur,"")!=0){
                    $laptop=LaptopVue::where('marque','=',$marque)
                    ->where('reference','ilike',"%".$valeur."%")
                    ->paginate(3);
                }
                else{
                    $laptop=LaptopVue::where('marque','=',$marque)->paginate(3);
                }
            }
            if($marque==0){
                if(strcmp($valeur,"")!=0){
                    $laptop=LaptopVue::where('reference','ilike',"%".$valeur."%")->paginate(3);
                }
            }
        }
        if(isset($data['marque'])){
            $marque=$data['marque'];
            $ram=$data['ram'];
            $ecran=$data['ecran'];
            $disque=$data['disque'];
            $processeur=$data['processeur'];
            $prix=$data['prix'];
            $laptop=LaptopVue::where('marque','like',"%%");
            if($marque!=0){
                $laptop=$laptop->where('marque','=',$marque);
            }
            if(strcmp('',$ram)!=0){
                $laptop=$laptop->where('ram','<=',$ram);
            }
            if(strcmp('',$ecran)!=0){
                $laptop=$laptop->where('ecran','<=',$ecran);
            }
            if(strcmp('',$disque)!=0){
                $laptop=$laptop->where('disquedur','<=',$disque);
            }
            if(strcmp('',$prix)!=0){
                $laptop=$laptop->where('prix','<=',$prix);
            }
            if($processeur!=0){
                $laptop=$laptop->where('idprocesseur','=',$processeur);
            }
            $laptop=$laptop->paginate(3);
        }
        $mess['laptop']=LaptopVue::dispo($laptop);
        $mess['marque']=Marque::all();
        $mess['processeur']=Processeur::all();
        $mess['reference']=ReferenceMarque::all();
        return view('homeAdmin')->with('data',$mess);
    }

    public function pointVenteAdmin(){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $mess['erreur']=session('erreur');
        $mess['pointvente']=PointVente::where('lieu','like','%%')->paginate(6);
        return view('pointVenteAdmin')->with('data',$mess);
    }

    public function marqueAdmin(){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $mess['erreur']=session('erreur');
        $mess['marque']=Marque::where('intitule','like','%%')->paginate(6);
        return view('marqueAdmin')->with('data',$mess);
    }

    public function processeurAdmin(){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $mess['erreur']=session('erreur');
        $mess['processeur']=Processeur::where('id','>','0')->paginate(6);
        $mess['typeprocesseur']=TypeProcesseur::all();
        return view('processeurAdmin')->with('data',$mess);
    }

    public function referenceAdmin(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $data=$req->all();
        $ref=ReferenceMarque::where('intitule','like','%%')->paginate(6);;
        $mess['processeur']=Processeur::all();
        if(isset($data['marqueid'])){
            $marque=$data['marqueid'];
            $valeur=$data['valeur'];
            if($marque!=0){
                if(strcmp($valeur,"")!=0){
                    $ref=ReferenceMarque::where('idmarque','=',$marque)
                    ->where('intitule','ilike',"%".$valeur."%")
                    ->paginate(6);
                }
                else{
                    $ref=ReferenceMarque::where('idmarque','=',$marque)->paginate(6);;
                }
            }
            if($marque==0){
                if(strcmp($valeur,"")!=0){
                    $ref=ReferenceMarque::where('intitule','ilike',"%".$valeur."%")->paginate(6);;
                }
            }
        }
        $mess['reference']=$ref;
        $mess['erreur']=session('erreur');
        $mess['marque']=Marque::all();
        return view('referenceAdmin')->with('data',$mess);
    }

    public function utilisateurAdmin(){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $mess['utilisateur']=Utilisateur::where('id','>','0')->paginate(6);
        $mess['pointvente']=PointVente::all();
        return view('utilisateurAdmin')->with('data',$mess);
    }

    public function transfertAdmin(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $mess['transfert']=Transfert::where('id','>','0')->paginate(6);
        $mess['pointvente']=PointVente::all();
        $mess['reference']=ReferenceMarque::all();
        $mess['erreur']=session('erreur');
        return view('transfertAdmin')->with('data',$mess);
    }

    public function venteAdmin(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $data=$req->all();
        $annee=2023;
        if(isset($data['annee'])){$annee=$data['annee'];}
        $mess['vente']=VenteGlobal::getAll($annee);
        $mess['total']=VenteGlobal::getTotal($annee);
        $mess['string']=VenteGlobal::getString($mess['vente']);
        $mess['pv']=PointVente::all();
        $mess['idpv']=null;
        $mess['npv']='';
        $mess['stringpv']='';
        if(isset($data['idpv'])){
            $mess['idpv']=VentePointVente::getAll($data['idpv'],$data['anneepv']); 
            $pv=PointVente::where('id','=',$data['idpv'])->get()[0];
            $mess['totalpv']=VentePointVente::getTotal($data['idpv'],$data['anneepv']);
            $mess['stringpv']=VentePointVente::getString($mess['idpv']).$pv->lieu;
            $mess['npv']=$pv->lieu;           
        }
        return view('venteAdmin')->with('data',$mess);
    }

    public function beneficeAdmin(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $data=$req->all();
        $annee=2023;
        if(isset($data['annee'])){$annee=$data['annee'];}
        $mess['vente']=VenteGlobal::getAll($annee);
        $mess['total']=VenteGlobal::getTotal($annee);
        $mess['string']=VenteGlobal::getString($mess['vente']);
        return view('beneficeAdmin')->with('data',$mess);
    }

    public function renvoiAdmin(){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $mess['erreur']=session('erreur');
        $mess['renvoi']=Renvoi::whereNull('qterecu')->paginate(6);
        return view('renvoiAdmin')->with('data',$mess);
    }

    public function commissionAdmin(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $data=$req->all();
        $mess['idpv']=null;
        if(isset($data['idpv'])){
            $mess['idpv']=VentePointVente::getAllMois($data['idpv'],$data['anneepv'],$data['moispv']);          
        }
        $mess['commission']=Commission::all();
        $mess['pv']=PointVente::all();
        return view('commissionAdmin')->with('data',$mess);
    }

    public function detailvente(Request $req){
        if(session('admin')==null){
            return view('loginAdmin');
        }
        $data=$req->all();
        $mois=$data['mois'];
        $annee=$data['annee'];
        $liste=VueVente::where('mois','=',$mois)->where('annee','=',$annee)->get();
        $mess['liste']=$liste;
        return view('detailvente')->with('data',$mess);
    }

    
    public function logout(){
        session()->forget('utilisateur');
        return view('login');
    }

    public function logoutAdmin(){
        session()->forget('admin');
        return view('loginAdmin');
    }
}
