<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VenteReference extends Model
{
    public $timestamps=false;
    protected $table='ventereference';

    protected $fillable = [
        'idreference',
        'sum',
        'idpointvente',
    ];
}
