<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    //
    protected $table = "list_municipios";
    protected $fillable = ['listm_id','listm_codigo','listm_nombre','listm_relacion'];
}