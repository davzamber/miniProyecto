<?php

namespace App\Http\Controllers;

use App\Models\Escritores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EscritoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['datosEscritor'] = Escritores::paginate(1);
        return view('escritor.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('escritor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {

        $campos = [
            'Nombres' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:100',
            'Foto' => 'required|max:10000|mimes:jpeg,png,jpg',
        ];
        $mensaje = [
            'required' => 'El :attribute es requerido',
            'Foto.required' => 'La foto es requerida'
        ];
        $this -> validate($request, $campos, $mensaje);

        $datosEscritor = request()->except('_token');
    
        if($request->hasFile('Foto')){
            $datosEscritor['Foto'] = $request->file('Foto')->store('uploads','public');
        }

        Escritores::insert($datosEscritor);
     //    return response()->json($datosEscritor);
     return redirect('escritor')->with('mensaje','Escritor agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Escritores  $escritores
     * @return \Illuminate\Http\Response
     */
    public function show(Escritores $escritores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Escritores  $escritores
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $escritores = Escritores::findOrFail($id);
        return view('escritor.edit', compact('escritores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Escritores  $escritores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $campos = [
            'Nombres' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:100',
        ];
        $mensaje = [
            'required' => 'El :attribute es requerido',
        ];
        if($request->hasFile('Foto')){
        $campos = ['Foto' => 'required|max:10000|mimes:jpeg,png,jpg',];
        $mensaje = ['Foto.required' => 'La foto es requerida'];
        }
        $this -> validate($request, $campos, $mensaje);



        $datosEscritor = request()->except('_token','_method');


        if($request->hasFile('Foto')){
            $escritores = Escritores::findOrFail($id);
            Storage::delete('public/'.$escritores->Foto);
            $datosEscritor['Foto'] = $request->file('Foto')->store('uploads','public');
        }

        Escritores::where('id','=',$id)->update($datosEscritor);

        $escritores = Escritores::findOrFail($id);
      //  return view('escritor.edit', compact('escritores'));
      return redirect('escritor')->with('mensaje', 'Editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Escritores  $escritores
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $escritores = Escritores::findOrFail($id);
        if(Storage::delete('public/'.$escritores->Foto)){
         Escritores::destroy($id);
        }
       
        return redirect('escritor')->with('mensaje', 'Borrado con éxito');

    }
}
