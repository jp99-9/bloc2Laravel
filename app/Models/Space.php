<?php

namespace App\Models;

use App\Models\User;
use App\Models\Address;
use App\Models\Comment;
use App\Models\Service;
use App\Models\Modality;
use App\Models\SpaceType;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{

    protected $fillable = [
        'name',
        'regNumber',
        'observation_ca',
        'observation_es',
        'observation_en',
        'email',
        'phone',
        'website',
        'accesType',
        'totalScore',
        'countScore',
        'address_id',
        'user_id',
        'space_type_id'
    ];

    protected $guarded = ['id'];


    public function address(){
        return $this->hasOne(Address::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }   

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function spaceType(){
        return $this->belongsTo(SpaceType::class);
    }

    public function modalities(){
        return $this->belongsToMany(Modality::class);
    }

    public function services(){
        return $this->belongsToMany(Service::class);
    }
}
