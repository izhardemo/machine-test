<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ball extends Model
{
    use HasFactory;

    protected $guarded = [];

    function bucketSuggestion() {
        return $this->belongsToMany(Bucket::class, BucketSuggestion::class, 'bucket_id', 'ball_id', 'id', 'id')->withPivot('ball_qty');
    }

    
}
