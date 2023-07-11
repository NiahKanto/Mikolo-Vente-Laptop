<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeProcesseur extends Model
{
    public $timestamps=false;
    protected $table='typeprocesseur';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'intitule',
    ];
}
