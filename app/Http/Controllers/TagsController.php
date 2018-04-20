<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
        $tags = Tag::Searh($request->name)->orderBy('id', 'DESC')->paginate(10);
    

        return view('admin.tags.index')->with('tags',$tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


        $tags = new Tag($request->all());
      
        if($tags->save()){ 

            return redirect()->route('tags.index')->with('msj', 'Tags' .$tags->name. ' Registrado Exitosamente');
    }else{
return back()->with('error', 'Ocurrio un Error al registrar Este Tags');
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

        $tags=Tag::find($id);
        return view('admin.tags.edit')->with('tags',$tags);
 
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

        $Tags= Tag::find($id);
        $Tags->fill($request->all());
       
   if($Tags->save()){ 
   
   
    return redirect()->route('tags.index')->with('msj', 'Tags '. $Tags->name . ' Modificado Exitosamente');
       }else{
   
           return back()->with('error', 'Ocurrio un Error al Modificar Este Tags');
   
   
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

        $Tags= Tag::find($id);
        //return redirect()->route('admin.user.index')
        
        if($Tags->delete()){ 
        
        return back()->with('msj', 'Tags '. $Tags->name . ' Eliminado Exitosamente');
            }else{
        
                return back()->with('error', 'Ocurrio un  al Eliminar este Tags');
        
            }

    }
}
