<?php

namespace App\Models;

use App\Models\Zone;
use App\Models\Municipality;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $fillable = [
        'name',
        'municipality_id',
        'zone_id'
    ];

    protected $guarded = ['id'];


    public function spaces()
    {
        return $this->hasOne(Space::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
