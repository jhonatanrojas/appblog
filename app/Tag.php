<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //

    protected $table ="tags";
    protected $fillable = ['name'];

    public function articulos(){
//relacion de muchos a muchos
return $this->belongsToMany('App\Articulo')->withTimestamps();

    }
}
