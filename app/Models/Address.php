<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $fillable = [
        'name',
        'municipality_id',
        'zone_id'
    ];

    protected $guarded = ['id'];

    
    public function spaces(){
        return $this->hasOne(Space::class);
    }
}
