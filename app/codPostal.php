<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class CodPostal extends Model
{
    protected $table = "codigo_postal";

public $idparr;
    //
    


    function getPostal($idparr){

       $this->idparr=$idparr;
       
      
       $consulta = DB::select("SELECT codp_id, codp_codigo
      
       FROM public.codigo_postal WHERE codp_parroquia  ='{$this->idparr}'  ");
        return  $consulta;

    }
}