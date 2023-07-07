<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bucket extends Model
{
    use HasFactory;

    protected $guarded = [];

    function bucketSuggestion()
    {
        return $this->belongsToMany(Ball::class, BucketSuggestion::class, 'ball_id', 'bucket_id', 'id', 'id')->withPivot('ball_qty');
    }

    function getNameAttribute()
    {
        return ucwords($this->attributes['name']);    
    }
}
