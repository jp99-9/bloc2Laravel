<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use App\Models\Space;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{

    protected $fillable = ['comment', 'score', 'space_id', 'user_id', 'status'];

    protected $guarded = ['id'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function space(){
        return $this->belongsTo(Space::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }
}
