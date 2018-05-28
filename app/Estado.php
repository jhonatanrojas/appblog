<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    //
    protected $table = "list_estado";
    protected $fillable = ['liste_id','liste_codigo','liste_nombre','liste_relacion'];

}