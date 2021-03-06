<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

use App\Http\Requests\categoriaRequest;
class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

            $categorias = Categoria::orderBy('id', 'DESC')->paginate(10);
            return view('admin.categorias.index')->with('categorias',$categorias);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(categoriaRequest $request)
    {
        
    

             $categoria = new Categoria($request->all());
        
        if($categoria->save()){ 

return redirect()->route('categorias.index')->with('msj', 'Categoria ' .$categoria->name. ' Registrada Exitosamente');
    }else{
return back()->with('error', 'Ocurrio un Error al registrar Esta Categoria');
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
        $categoria=Categoria::find($id);
        return view('admin.categorias.edit')->with('categoria',$categoria);
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
        $categoria= categoria::find($id);
        $categoria->fill($request->all());
       
   if($categoria->save()){ 
   
   
    return redirect()->route('categorias.index')->with('msj', 'Categoria '. $categoria->name . ' Modificada Exitosamente');
       }else{
   
           return back()->with('error', 'Ocurrio un Error al Modificar Esta Categoria');
   
   
       }

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


        $categoria = Categoria::find($id);
        if( $categoria->delete()){ 

            return back()->with('msj', 'Categoria '. $categoria->name . ' Eliminado Exitosamente');
                }else{
            
                    return back()->with('error', 'Ocurrio un  al Eliminar este');
            
                }
            
    }
}
