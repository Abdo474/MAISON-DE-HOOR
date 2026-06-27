<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['name', 'filename', 'video_data', 'mime_type', 'file_size', 'collection_id'];

    public function collection()
    {
        return $this->hasOne(Collection::class);
    }
}
