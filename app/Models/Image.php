<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{

    protected $fillable = ['url', 'comment_id'];

    protected $guarded = ['id'];

    use HasFactory;
    public function comment(){
        return $this->belongsTo(Comment::class);
    }
}
