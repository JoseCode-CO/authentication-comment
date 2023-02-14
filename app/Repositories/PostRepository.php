<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class PostRepository implements PostRepositoryInterface
{

    public function getAll()
    {
        return Post::with('messages', 'messages.attachments')->get();
    }

    public function findById($id)
    {
        return Post::with('messages')->findOrFail($id);
    }

    public function create($request)
    {
        $post = Post::create([
            'created_by' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return $post;
    }

    public function update($data, $id)
    {
        $post = Post::findOrfail($id);

        if ($post->created_by != Auth::id()) {
            return  response([
                "message" => "No tiene permisos para editar este registro"
            ], Response::HTTP_BAD_REQUEST);
        }

        $post->update($data);
        return $post;
    }

    public function delete($id)
    {
        $post = Post::findOrfail($id);

        if ($post->created_by != Auth::id()) {
            return  response([
                "message" => "No tiene permisos para eliminar este registro"
            ], Response::HTTP_BAD_REQUEST);
        }

        $post->delete();
        return $post;
    }
}
