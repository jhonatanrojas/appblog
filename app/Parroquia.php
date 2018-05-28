<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Parroquia extends Model
{

public $idmun;
public $idparr;
public $codestado;
    //
    protected $table = "list_parroquia";
    protected $fillable = ['listprr_id','listprr_codigo','listprr_nombre','listrr_relacion'];


    function getParroquia($idmun){

       $this->idmun=$idmun;
       
       $consulta = DB::select("SELECT DISTINCT(listprr_codigo),   listm_codigo,listm_nombre,
        listprr_nombre 
       FROM codigo_postal 
      
       INNER JOIN list_municipios ON
       codp_municipio::integer = listm_codigo::integer 
      
        INNER JOIN list_parroquia ON
      codp_ciudad::integer = listprr_relacion
      WHERE listm_codigo ='{$this->idmun}'   
      ORDER BY listm_codigo");
        return  $consulta;

    }


    function getPostal($idparr, $idmun, $codestado){

        $this->idparr=$idparr;
        $this->codestado = $codestado;
       $this->idmun=$idmun;
       
        $consulta = DB::select("SELECT codp_id, codp_codigo
       
        FROM public.codigo_postal WHERE codp_parroquia  ='{$this->idparr}' OR codp_municipio = '{$this->idmun}' OR codp_estado = '{$this->codestado}' ");
         return  $consulta;
 
     }
}