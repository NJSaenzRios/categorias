<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['categorias']=Categoria::paginate(15);
        return view("categoria.index", $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('categoria.create');
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
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Descripcion'=>'required|string|max:100',          
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',            
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto es requerida',

        ];

        $this->validate($request, $campos, $mensaje);
        
        $datosCategoria = request()->except('_token');
        
        if($request->hasFile('Foto')){
            $datosCategoria['Foto']=$request->file('Foto')->store('uploads', 'public');
        }
        
        Categoria::insert($datosCategoria);   
        
        //retorna a la pagina y emite mensaje
        return redirect('categoria')->with('mensaje','Categoria agregada con exito');




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria=Categoria::findOrFail($id);
        return view('categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $campos=[
            'Nombre'=>'required|string|max:100',
            'Descripcion'=>'required|string|max:100',
           
            
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
            

        ];

        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg',];
            $mensaje=['Foto.required'=>'La foto requerida'];
        }


        $this->validate($request, $campos, $mensaje);
        
        $datosCategoria = request()->except(['_token', '_method']);
        
        if($request->hasFile('Foto')){

            $categoria=Categoria::findOrFail($id);

            Storage::delete('public/'.$categoria->Foto);

            $datosCategoria['Foto']=$request->file('Foto')->store('uploads', 'public');
        }
          
               
        Categoria::where('id','=',$id)->update($datosCategoria);
       
        $categoria=Categoria::findOrFail($id);
       

        return redirect('categoria')->with('mensaje', 'Categoria Modificado');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */

    public function destroy ($id)
    {
       $categoria=Categoria::findOrFail($id);

        //borrado de la foto, destruyendo el registro en uploads
        
        if(Storage::delete('public/.$categoria->Foto')){
           //borra el registro de datos
            Categoria::destroy($id);

        }
        
        return redirect('categoria')->with('mensaje','Categoria borrado con exito');

    }
}
