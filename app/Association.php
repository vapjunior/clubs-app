<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    protected $fillable = [
        'club_id',
        'affiliate_id',
        'associeted',
    ];

    public function club() {
        return $this->belongsTo('App\User', 'club_id');
    }

    public function affiliate() {
        return $this->belongsTo('App\Affiliates', 'affiliate_id');
    }
}
