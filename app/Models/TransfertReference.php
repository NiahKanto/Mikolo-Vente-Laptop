<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransfertReference extends Model
{
    public $timestamps=false;
    protected $table='transfertreference';

    protected $fillable = [
        'idreference',
        'sum',
    ];
}
