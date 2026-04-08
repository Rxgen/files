<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class MediaGallery extends Model
{
    public function galleryType() {
    	return $this->belongsTo('App\GalleryType', 'galleryType', 'id');
    }
}
