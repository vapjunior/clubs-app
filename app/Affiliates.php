<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Affiliates extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];

    public function associations() {
        return $this->hasMany('App\Association');
    } 
}
