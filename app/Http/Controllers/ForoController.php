<?php

namespace App\Http\Controllers;

use App\Models\Foro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ForoController extends Controller
{

   public function index(Request $request)
   {
       $user_id = $request->input('user_id');
       $foro = Foro::where('user_id', $user_id)->get();

       return response()->json($foro);
   }

   public function foroall()
   {
       $perPage = Foro::count(); // Número de productos por página
       $page = request('page', 1); // Obtener el número de página de la solicitud
       $foro = Foro::skip(($page - 1) * $perPage)->take($perPage)->get();

       return response()->json($foro);
   }


   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
       $foro = new Foro();
       $foro->title = $request->title;
       $foro->content = $request->content;
       $foro->user_id = $request->user_id;
       $foro->save();

       return response()->json([
           'foro' => $foro
       ]);
   }

   /**
    * Display the specified resource.
    */
   public function show(Foro $foro)
   {
       return response()->json($foro);
   }


   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, Foro $foro)
   {
       $foro->title = $request->title;
       $foro->content = $request->content;
       $foro->user_id = $request->user_id;
       $foro->save();

       return response()->json([
           'foro' => $foro
       ]);
      
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(Foro $foro)
   {

       $foro->delete();
       return response()->json([
           'mensaje' => 'producto borrado con exito'
       ]);
   }
}
