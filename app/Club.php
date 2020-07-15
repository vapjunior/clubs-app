<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];

    public function associations() {
        return $this->hasMany('App\Association');
    }

}
