<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\ItemViaje;
use App\Models\Viaje;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $items = Item::get();
        
        $msg = "";
        return view('item.lista')->with(['request'=>$request])->with(['items' =>$items])->with('msg',$msg);
    }
    
    public function crearForm()
    {
        $data = '';
        return view('item.crear', ['data' =>$data]);
    }
    public function crear(Request $request)
    {   $msg = "El item se cargó con éxito";
        try {
            $request->validate(['nombre' => 'required',
            'precio' => 'required',
            ]);
            $nombre = $request->input('nombre');
            $cantidadItems= Item::where("nombre", "=", $nombre)->count();
            if ($cantidadItems == 0){
                $item = new Item;
                $item->nombre = $request->input('nombre');
                $item->precio = $request->input('precio');
                $item->save();
            }
            else{
                $msg = "el nombre de item ingresado ya esta registrado en el sistema";
            }
            return view('item.crear', ['data' =>$msg]);
        } catch (\Illuminate\Database\QueryException $th) {
            $msg = "el precio o stock ingresado no es valido";
            return view('item.crear', ['data' =>$msg]);
        }   
        
              
    }
    public function actualizarForm(Item $item)
    {
        $msg = "";
        return view('item.actualizar')->with('item',$item)->with('data',$msg);
       // return view("item.actualizar", compact("item"));
    }
    public function actualizar(Item $item)
    {
        $msg ="el item se actualizó con éxito";
        try {
            $item->update([
                'nombre'=>request('nombre'),
                'precio'=>request('precio'),
            ]);
            
            
        } catch (\Illuminate\Database\QueryException $th) {
            $needle = 'item_nombre_unique';
            if (str_contains($th, $needle)) {
                $msg = 'el nombre de item ingresado ya esta registrado en el sistema';
            }
            else{
                $msg = 'el nombre de item ingresado ya esta registrado en el sistema2';
            }
            //return view('item.actualizar')->with('item',$item)->with('data',$msg);
        }   
        catch(Illuminate\Database\Eloquent\Collection $e){
            $msg = "no se";
        }
        return view('item.actualizar')->with('item',$item)->with('data',$msg);
    
/*$nombre2 = request('nombre');
        $cantidadItems= Item::where("nombre", "=", $nombre2)->count();
        if ($cantidadItems == 0){
            $item->update([
                'nombre'=>request('nombre'),
                'precio'=>request('precio'),
                'stock'=>request('stock'),
            ]);
        }
        else{
            if ($cantidadItems == 1){
                $item->update([
                    'nombre'=>request('nombre'),
                    'precio'=>request('precio'),
                    'stock'=>request('stock'),
                ]);
            #informar que ya existe un item con ese nombre
            }
        }
        return redirect()->route('item.index');*/

        /*$item = Item::where("nombre","=","$request->input('nombre')");
        $item->nombre = $request->input('nombre');
        $item->precio = $request->input('precio');
        $item->stock = $request->input('stock');
        $item->save();
        */
    }
    public function eliminar(Item $item)
    {
        $viajes = ItemViaje::where('nombreItem','=',$item->nombre)->get();
        $msg = "el item se  borró con éxito ";
        if ($viajes->count() ==0){
            $item->delete();
        }
        else{
            $msg = "el item no se puede borrar";
        }
        $items = Item::all();
        return view('item.lista')->with(['items' =>$items])->with('msg',$msg);
        
    }
    
    
    public function confirmarBorrado(Item $item)
    {
        return view('item.confirmarBorrado',compact('item'));
    }
    public function cancelar()
    {
        return redirect()->route('item.index');
    }

}
