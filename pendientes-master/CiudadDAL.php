<?php

namespace App\Wsorinoco\Dal;

use DB;

 

class CiudadDAL 
{
    public function getInfoCiudad($codestado,$codciudad,$nbciudad){
        
        if($nbciudad<>''){
            
             $condicion=" AND listc_nombre LIKE :nbciudad ";
             $arrayParametros =  array('nbciudad' => "$nbciudad%");
             
           
        } 
        else{
         
            if ($codestado=='ALL'){  //Busco toda la tabla
                $condicion='';
                $arrayParametros = array();
            }
         
            else if  ($codestado<>'ALL'  && $codciudad=='ALL'){
                $condicion=' AND  estado.codestado=:codestado ';
                $arrayParametros = array('codestado'=>$codestado);
            }
            else if ($codciudad<>'ALL'){
                $condicion=' AND  list_ciudad.listc_codigo=:codciudad ';
                $arrayParametros = array('codciudad'=>$codciudad);
            }
        }
         
    
        $pgSQL=DB::select('SELECT list_ciudad.* FROM estado,list_ciudad,ciudad WHERE estado.codestado=ciudad.codestado AND ciudad.codciudad=list_ciudad.codciudadzoom '.$condicion,$arrayParametros);               
         return $pgSQL;
        
    }
    
    public function getInfoCiudad_2($nbciudad){
                
        if ($nbciudad=='ALL'){
            
            $condicion=' ORDER BY listc_nombre,listc_codigo ';
            $arrayParametros=array();
            
            
        }
        
        else{
            
            $condicion=" AND listc_nombre LIKE :nbciudad ORDER BY listc_nombre,listc_codigo";
            $arrayParametros =  array('nbciudad' => "$nbciudad%");
        }
        
        
        $pgSQL=DB::select("SELECT rtrim(a.listc_codigo) AS listc_cod, a.codciudadzoom AS listc_codigozoom,a.listc_nombre,rtrim(b.codp_codigo) AS codp_codigo,      codp_ciudad, codp_estado,rtrim(c.liste_codigo) AS liste_codigo,c.liste_nombre,rtrim(codp_municipio) AS codp_municipio,listm_nombre,rtrim(listprr_codigo) AS listprr_codigo,rtrim(d.listprr_nombre) AS listprr_nombre FROM list_ciudad a, codigo_postal b, list_estado c,list_parroquia d, list_municipios e WHERE codp_ciudad = listc_codigo AND codp_estado = liste_codigo AND listc_codigo::integer = listprr_relacion  AND codp_municipio::integer = listm_codigo::integer AND codp_parroquia = listprr_codigo".$condicion,$arrayParametros);
        
        return $pgSQL;
    
          
    }

    public function getCiudades()
    {
     
      
                $respuesta = DB::table('ciudad')
                    ->where(function ($query) {
                        $query->where('ciudad.inactivo', '<>', 't');
                        $query->orWhere('ciudad.inactivo', '=', null);
                    })
                    ->join('oficina', 'oficina.codciudad', '=', 'ciudad.codciudad')
                    ->where(function ($query) {
                        $query->where('oficina.inactivo', '<>', 't');
                        $query->orWhere('oficina.inactivo', '=', null);
                    })
                    ->where('oficina.estacionope', '=', 't')
                    ->join('estado', 'ciudad.codestado', '=', 'estado.codestado')
                    ->where('estado.codpais', '=', 124)
                    ->select('ciudad.nombre as nombre_ciudad', 'estado.nombre as nombre_estado', 'ciudad.codciudad')
                    ->orderBy('ciudad.nombre')
                    ->get();
              
        foreach ($respuesta as $item) {
            $item->nombre_ciudad = utf8_encode($item->nombre_ciudad);
            $item->nombre_estado = utf8_encode($item->nombre_estado);
        }
        return $respuesta;
    }

}   //END CLASS estado
?>


