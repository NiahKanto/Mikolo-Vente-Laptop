<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RenvoiReference extends Model
{
    public $timestamps=false;
    protected $table='renvoireference';

    protected $fillable = [
        'idreference',
        'sum',
        'recu',
    ];
}
