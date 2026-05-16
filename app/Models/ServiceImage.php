<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceImage extends Model
{
    protected $table = 'images_portfolio';
    protected $fillable = ['service_id', 'image_path'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
