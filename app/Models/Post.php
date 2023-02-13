<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "posts";

    protected $fillable = [
        'created_by',
        'title',
        'content'
    ];

    public $timestamps = true;

    public function coments()
    {
        return $this->hasMany(Message::class, 'id');
    }
}
