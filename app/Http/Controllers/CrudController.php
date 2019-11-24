<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CrudProffesion;
use DB;
use Auth;

/**
 * Las funciones no retornan una vista ya que son llamadas por axios
 * y solo deben de retornar datos
 */

class CrudController extends Controller
{
    public function index(){

        if (!empty(Auth::user()->name)) {
            $user = Auth::user()->name;
        } else {
            $user = '';
        }

        return view('crud', compact('user'));
    }

    public function storeItem(Request $request){
        $data = CrudProffesion::create([
            'name' => $request->name,
            'description' => $request->description,
            'content' => $request->content,
            'price' => $request->price,
        ]);

        return $data;
    }

    public function readItems(){
        $data = CrudProffesion::all();

        return $data;
    }

    public function readItemsUpdate($id){
        $data = DB::table('crudproffesion')
                    ->where('id', $id)
                    ->select('name', 'description', 'content', 'price')
                    ->get();

        return $data;
    }

    public function updateItems(Request $request, $id){
        $data = DB::table('crudproffesion')
                    ->where('id', $id)
                    ->update([
                        'name' => $request->name,
                        'description' => $request->description,
                        'content' => $request->content,
                        'price' => $request->price,
                    ]);

        return $data;
    }

    public function deleteItems($id){
        $data = DB::table('crudproffesion')
                    ->where('id', $id)
                    ->delete();

        return $data;
    }

    public function getProffesion(){
        $show = CrudProffesion::ShowCrud();

        return view('showcrud', compact('show'));
    }

    public function PassMountOpenpay(Request $request){
        return view('/');
    }
}
