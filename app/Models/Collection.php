<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'image', 'video_id', 'media', 'media_type'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
