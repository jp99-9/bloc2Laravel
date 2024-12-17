<?php

namespace App\Models;

use App\Models\Space;
use Illuminate\Database\Eloquent\Model;

class SpaceType extends Model
{

    protected $fillable = ['name', 'description_ca', 'description_es', 'description_en'];

    protected $guarded = ['id'];
    
    public function spaces(){
        return $this->hasMany(Space::class);
    }
}
