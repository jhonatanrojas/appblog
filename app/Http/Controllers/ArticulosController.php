<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Categoria;
use App\Articulo;
use App\Imagen;
use Illuminate\Support\Facades\Auth;

class ArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $categoria = Categoria::orderBy('name','ASC')->pluck('name','id');
       $tags = Tag::orderBy('name','ACS')->pluck('name','id');

     

       return view('admin.articulos.create')
           -> with('categoria',$categoria)
           ->with('tags',$tags);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        if($request->file('image'))
        { 
            $file =$request->file('image');
            $name = 'imagen_'. time() . '.' . $file->getClientOriginalName();
            //$nameimagen = str_random(30) . '-' . $request->file('image')->getClientOriginalName();
            $path = public_path() . '/imagenes/articulos';
           // $file->move($path,$name);

        }


            $articulo=new Articulo ($request->all());
            $iduser = Auth::user()->id;
            $articulo->user_id =  $iduser;


            $articulo->save();
            $articulo->tags()->sync($request->tags);

            $imagen = new Imagen();
            $imagen->name= $name;
            $imagen-> articulo()->associate($articulo);
          $imagen->save(); 

          
        if($articulo->save()){ 

            return redirect()->route('articulos.create')->with('msj', 'Articulo ' .   $articulo->titulo. ' Publicado Exitosamente');
                }else{
            return back()->with('error', 'Ocurrio un Error al registrar Este Articulo');
                }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
