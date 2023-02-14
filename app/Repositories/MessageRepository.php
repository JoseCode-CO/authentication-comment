<?php

namespace App\Repositories;

use App\Interfaces\MessageRepositoryInterface;
use App\Models\Attachment;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class MessageRepository implements MessageRepositoryInterface
{
    public function getAll()
    {
        return Message::with('post', 'senderUser', 'receiverUser', 'attachments')->get();
    }

    public function findById($id)
    {
        return Message::with('post', 'senderUser', 'receiverUser', 'attachments')->findOrFail($id);
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
}
