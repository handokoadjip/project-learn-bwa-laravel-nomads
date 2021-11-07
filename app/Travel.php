<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Travel extends Model
{
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($travelPhoto) {
            $travelPhoto->photos()->delete();
            $travelPhoto->transactions()->delete();
        });
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'travels';

    protected $fillable = [
        'id', 'title', 'slug', 'location', 'about', 'event', 'language', 'food', 'departure', 'duration', 'type', 'price'
    ];

    protected $hidden = [];

    public function photos()
    {
        return $this->hasMany(TravelPhoto::class, 'travel_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'travel_id', 'id');
    }
}
