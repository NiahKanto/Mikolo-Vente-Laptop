<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RenvoiReferenceP extends Model
{
    public $timestamps=false;
    protected $table='renvoireferencep';

    protected $fillable = [
        'idreference',
        'sum',
        'idpointvente',
    ];
}
