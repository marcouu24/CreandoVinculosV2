<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Centro;
use App\Models\Categoria;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;


class CentrosController extends Controller
{
    public function index(Request $request)
    {
        return view('centros.index');        
    }


    public function crear()
    {
        $categorias= Categoria::all();
        $centro= New Centro();
        return view('centros.crear', compact('centro','categorias'));
    }



    public function editar($id)
    {
        $categorias= Categoria::all();
        $centro =  Centro::find($id);
        return view('centros.editar',compact('centro','categorias'));
    }


    public function guardar(Request $request)
    {
        try{
           /*   dd($request);  */
            if ( $request->id ) {
                $centro_existente = Centro::where('nombre', $request['nombre'])->first();

                if($centro_existente != null && $centro_existente->id != $request->id){
                    alert()->error('Error','Ya existe una centro con ese nombre');
                    return redirect()->back()->withInput();
                }
                
                $centro = Centro::findOrFail($request->id);
                $centro->id_categoria =$request->id_categoria;
                $centro->nombre =$request->nombre;
                $centro->direccion =$request->direccion;
                $centro->sector =$request->sector;
                $centro->representante =$request->representante;
                $centro->correo =$request->correo;
                $centro->horario =$request->horario;
                $centro->latitud =$request->latitud;
                $centro->longitud =$request->longitud;
                $centro->save();

            }else{

                $centro_existente = Centro::where('nombre', $request['nombre'])->first();
                if($centro_existente == null){

                    $centro = Centro::create(
                        [
                            'id_categoria' => $request->id_categoria,
                            'nombre' => $request->nombre,
                            'direccion' => $request->direccion,
                            'sector' => $request->sector,
                            'representante' => $request->representante,
                            'correo' => $request->correo,
                            'horario' => $request->horario,
                            'latitud' => $request->latitud,
                            'longitud' => $request->longitud,
                        ]
                    );
                }
                else{
                    alert()->error('Error','Ya existe un centro con ese nombre');
                    return redirect()->back()->withInput();
                }
            } 
            alert()->success('¡Éxito!','Centro guardado satisfactoriamente');
            return redirect(route('centros.index'));
        }catch(Exception $e){
            alert()->error('Error','No se pudo guardar el centro, intente nuevamente');
            report($e);
            return redirect()->back()->withInput();
        }
    }



    public function listar(Request $request) 
    {     
        if ($request->ajax()) {
            $data = Centro::all();     
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($centro){
               
                    $actionBtn = '<a href="'.route('centros.editar',$centro->id).'" class="edit btn btn-warning btn-sm ">Editar</a> 
                    
                    <form action="'.route('centros.eliminar',$centro->id).'" class="d-inline js-form-eliminar" method="post">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="delete" />
                        <input class="delete btn btn-danger btn-sm" type="submit" value="Eliminar" />    
                    </form>';
                    return $actionBtn;
                
            })  
            ->addColumn('categoria', function($centro){

                    return $centro->categoria->nombre;
                
                
            })                    
            ->rawColumns(['action']) 
            ->make(true);
        }
    }



    public function eliminar($id){
        try {
            Centro::find($id)->delete();
            alert()->success('Éxito','Centro eliminado correctamente.');
            return redirect()->route('centros.index');
        } catch (Exception $e) {
            
            alert()->error('Error','No se pudo eliminar el centro, intente nuevamente');
            report($e);
            return redirect()->back();
        }
    }

}