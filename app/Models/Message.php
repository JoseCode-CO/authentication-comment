<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "messages";

    protected $fillable = [
        'post_id',
        'sender_id',
        'receiver_id',
        'message',
    ];

    public $timestamps = true;

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'id');
    }

    public function senderUser()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiverUser()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
