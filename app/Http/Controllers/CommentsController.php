<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index(Request $request)
    {
        $foro_id = $request->input('foro_id');
        $comment = Comment::where('foro_id', $foro_id)->get();
 
        return response()->json($comment);
    }
 
    public function foroall()
    {
        $perPage = Comment::count(); // Número de productos por página
        $page = request('page', 1); // Obtener el número de página de la solicitud
        $comment = Comment::skip(($page - 1) * $perPage)->take($perPage)->get();
 
        return response()->json($comment);
    }
 
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Comment $comment)
    {
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = $request->user_id;
        $comment->foro_id = $request->foro_id;
        $comment->save();
 
        return response()->json([
            'comment' => $comment
        ]);
    }
 
    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return response()->json($comment);
    }
 
 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->content = $request->content;
        $comment->user_id = $request->user_id;
        $comment->foro_id = $request->foro_id;
        $comment->save();
 
        return response()->json([
            'comment' => $comment
        ]);
       
    }
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
 
        $comment->delete();
        return response()->json([
            'mensaje' => 'producto borrado con exito'
        ]);
    }
}
