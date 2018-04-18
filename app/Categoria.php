<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    protected $table = "categorias";
    protected $fillable = ['name'];
    
    public function articulos ()
    {
///relacion de uno a muchos
        return $this->hasMany('App\Articulo');
    }
}
