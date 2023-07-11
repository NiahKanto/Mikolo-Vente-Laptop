<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\StockPointVente;
use App\Libraries\FPDF\MyFPDF;

class VenteController extends Controller
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
        $ref=StockPointVente::where('idreference','=',$nouveau['idreference'])
        ->where('idpointvente','=',$nouveau['idpointvente'])
        ->get();
        if(count($ref)!=0){
            $reference=$ref[0];
            $qte=$reference->getQtePV();
            if($qte>=$data['qte']){
                Vente::nouveau($data);
            }
            else{
                return redirect()->route('laptop')->with('erreur','Vente Impossible<br>A vendre : '.$data['qte'].'<br> Disponible : '.$qte);    
            }
        }
        else{
            return redirect()->route('laptop')->with('erreur','Vente  impossible, le point de vente n a pas ce produit ');  
        }
        return app()->call('App\Http\Controllers\UtilisateurController@laptop');
    }

    public function supprimer(Request $req){
        if(session('utilisateur')==null){
            return view('login');
        }
        $nouveau = $req->all();
        $data['id']=$nouveau['id'];
        Vente::supprimer($data);
        return app()->call('App\Http\Controllers\UtilisateurController@listevente');
    }

    public function generatePDF(Request $req)
    {
        $data=$req->all();
        require_once(app_path() . '/Libraries/FPDF/MyFPDF.php');
        $pdf = new MyFPDF();
        $pdf->AddPage();
        $publicpath = public_path();
        $pdf->SetFont('Arial', 'B', 5);
        $type=$data['type'];
        $string=$data['string'];
        $liste=explode("|",$string);
        $pdf->Cell(20, 10, "Total des ventes de l'annee ".explode(";",$liste[0])[9]);
        if($type==0){
            $filepath = $publicpath . '/tmp.jpg'; 
            $pdf->Image($filepath,20, 20, 100, 0);
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Cell(30, 10, 'MOIS');
            $pdf->Cell(60, 10, 'NOMBRE');
            $pdf->Cell(90, 10, 'MONTANT');
        }
        if($type==1){
            $pdf->Cell(5, 10, 'MOIS');
            $pdf->Cell(10, 10, 'MONTANT');
            $pdf->Cell(15, 10, 'ACHAT');
            $pdf->Cell(20, 10, 'BENEF');
            $pdf->Cell(25, 10, 'PERTE');
            $pdf->Cell(30, 10, 'BENEF');
            $pdf->Cell(35, 10, 'COMM');
            $pdf->Cell(40, 10, 'BENEF');
        }
        $pdf->Ln();
        for($i=0;$i<count($liste)-1;$i++){
            $str=$liste[$i];
            $val=explode(";",$str);
            if($type==0){
                $pdf->Cell(30, 10, $val[0]);
                $pdf->Cell(60, 10, $val[1]);
                $pdf->Cell(90, 10, $val[2]);
            }
            if($type==1){
                $pdf->Cell(5, 10, $val[0]);
                $pdf->Cell(10, 10, $val[2]);
                $pdf->Cell(15, 10, $val[3]);
                $pdf->Cell(20, 10, $val[4]);
                $pdf->Cell(25, 10, $val[5]);
                $pdf->Cell(30, 10, $val[6]);
                $pdf->Cell(35, 10, $val[7]);
                $pdf->Cell(40, 10, $val[8]);
            }
            $pdf->Ln();
            $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + $pdf->GetPageWidth() - $pdf->GetX(), $pdf->GetY());
        }
        $pdf->Output();
    }

    public function uploadImage(Request $request)
    {
        $data=$request->all();
        $img=$data['image'];
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));
        $filename = 'tmp.jpg';
        $publicpath = public_path();
        $filepath = $publicpath . '/' . $filename; 
        file_put_contents($filepath, $image);  
    }

    public function generatePDFpv(Request $req)
    {
        $data=$req->all();
        require_once(app_path() . '/Libraries/FPDF/MyFPDF.php');
        $pdf = new MyFPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $string=$data['string'];
        $liste=explode("|",$string);
        $pdf->Cell(40, 10, 'Point de vente - '.$liste[count($liste)-1]);
        $pdf->Ln();
        $pdf->Cell(40, 10, 'MOIS');
        $pdf->Cell(80, 10, 'NOMBRE');
        $pdf->Cell(80, 10, 'QUANTITE');
        $pdf->Ln();
        for($i=0;$i<count($liste)-1;$i++){
            $str=$liste[$i];
            $val=explode(";",$str);
            $pdf->Cell(30, 10, $val[0]);
            $pdf->Cell(60, 10, $val[1]);
            $pdf->Cell(90, 10, $val[2]);
            $pdf->Ln();
            $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + $pdf->GetPageWidth() - $pdf->GetX(), $pdf->GetY());
        }
        $pdf->Output();
    }

}
