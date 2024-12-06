<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function spaces(){
        return $this->hasOne(Space::class);
    }
}
