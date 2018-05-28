<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estado;
use App\Municipio;
use App\Parroquia;

class RegistrarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estado =  new Estado();
         $estados=$estado->all();
        return view('admin.articulos.registrar')->with('estados',$estados);;
    }

    public function getMunicipio(Request $request){

        $mun= $Municipio=Municipio::where('listm_relacion', $request->listm_relacion)->get();

        return response()->json($mun);     


    }


    public function getParroquias(Request $request){

        $Parroquias= new Parroquia();
    
        $result=$Parroquias->getParroquia($request->x_mun);
        return response()->json($result);     
    }





    public function getCodPostal(Request $request){

        $CodPostal=  new Parroquia();
        
        $result=$CodPostal->getPostal($request->codpostal,$request->codmun,$request->codestado );
        return response()->json($result);     
    }
}
