<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelPhoto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'travel_id', 'path'
    ];

    protected $hidden = [];

    public function travel()
    {
        return $this->belongsTo(Travel::class, 'travel_id', 'id');
    }
}
