<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
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
        $us = User::create($inputs);
        return response()->json([
            'data'=>$us,
            'mensaje'=>"Usuario creado con exito"
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
        $us = User::find($id);
        if(isset($us)){
            return response()->json([
                'data'=> $us,
                'mensaje'=> "Usuario encontrado"
            ]);
        } else{
            return response()->json([
                'error'=>true,
                'mensaje'=> "No existe el usuario"
            ]);
        }
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
        $us = User::find($id);
        if (isset($us)){
            $us->first_name = $request->first_name;
            $us->last_name = $request->last_name;
            $us->email = $request->email;
            //$us->password = Hash::make($request->password);

            if ($us->save()){
                return response()->json([
                    'data'=>$us,
                    'mensaje'=>"Usuario actualizado",
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
        $us = User::find($id);
        if(isset($us)){
            $res = User::destroy($id);
            if($res){
                return response()->json([
                    'data'=>[],
                    'mensaje'=> "Usuario eliminado"
                ]);
            }
        } else{
            return response()->json([
                'error'=>true,
                'mensaje'=> "No existe usuario para eliminar"
            ]);
        }
    }
}
