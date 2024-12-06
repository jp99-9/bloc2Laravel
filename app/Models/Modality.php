<?php

namespace App\Models;

use App\Models\Space;
use Illuminate\Database\Eloquent\Model;

class Modality extends Model
{
    public function spaces(){
        return $this->belongsToMany(Space::class);
    }
}
