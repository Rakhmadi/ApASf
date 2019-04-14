<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class datamodel extends Model
{
    protected $table='data';
    protected $fillable=
    [
        'name_product',
        'discription',
        '',
    ];
}
