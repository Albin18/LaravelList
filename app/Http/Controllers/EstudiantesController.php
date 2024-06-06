<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Estudiante::all();
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
        $inputs = $request->input();
        $est = Estudiante::create($inputs);
        return response()->json([
            'data'=>$est,
            'mensaje'=>"Estduainte creado con exito"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $est = Estudiante::find($id);
        if(isset($est)){
            return response()->json([
                'data'=> $est,
                'mensaje'=> "Estudiante encontrado"
            ]);
        } else{
            return response()->json([
                'error'=>true,
                'mensaje'=> "No existe el estudiante"
            ]);
        }
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
        $est = Estudiante::find($id);
        if (isset($est)){
            $est->nombre = $request->nombre;
            $est->apellido = $request->apellido;
            $est->foto = $request->foto;

            if ($est->save()){
                return response()->json([
                    'data'=>$est,
                    'mensaje'=>"Estudiante actualizado",
                ]);
            } else{
                return response()->json([
                    'error'=> true,
                    "mensaje"=> "No se pudo actualizar",
                ]);
            }

        }else{
            return response()->json([
                'error'=>true,
                'mensaje'=>"No Existe el estudiante",
            ]);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $est = Estudiante::find($id);
        if(isset($est)){
            $res = Estudiante::destroy($id);
            if($res){
                return response()->json([
                    'data'=>[],
                    'mensaje'=> "Estudiante eliminado"
                ]);
            }
        } else{
            return response()->json([
                'error'=>$est,
                'mensaje'=> "No existe estudiante para eliminar"
            ]);
        }
    }
}
