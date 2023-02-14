<?php

namespace App\Repositories;

use App\Models\Attachment;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class MessageRepository
{
    public function getAll()
    {
        return Message::with('post', 'attachments')->get();
    }

    public function findById($id)
    {
        return Message::with('post', 'attachments')->findOrFail($id);
    }

    public function create($request)
    {
        $message = Message::create([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'post_id' => $request->post_id,
            'message' => $request->message,
        ]);

        if ($request->hasFile('attachments')) {
            $attachment = $request->file('attachments');
            $path = $attachment->store('attachments');

            Attachment::create([
                'message_id' => $message->id,
                'path' => $path,
                'type' => 1
            ]);

        }

        return $message;
    }

    public function update($data, $id)
    {
        $post = Message::findOrfail($id);

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
        $post = Message::findOrfail($id);

        if ($post->created_by != Auth::id()) {
            return  response([
                "message" => "No tiene permisos para eliminar este registro"
            ], Response::HTTP_BAD_REQUEST);
        }

        $post->delete();
        return $post;
    }
}
