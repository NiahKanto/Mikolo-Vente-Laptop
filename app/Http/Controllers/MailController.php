<?php

namespace App\Http\Controllers;

use App\Mail\MonEmail;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public function envoi(){
        $destinataire = 'rasamy.bogosy@gmail.com';
        Mail::to($destinataire)->send(new MonEmail());
    }

}
