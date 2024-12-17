<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Municipality;

class Island extends Model
{

    protected $fillable = ['name'];
    protected $guarded = ['id'];
    
    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }
}
