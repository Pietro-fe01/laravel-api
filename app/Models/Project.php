<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['slug', 'cover_image'];

    // To get the full URL of the uploaded images
    protected $appends = ['image_url'];

    protected function getImageUrlAttribute() {
        return $this->cover_image ? asset("storage/$this->cover_image") : 'https://via.placeholder.com/250x150?text=No+Image+selected';
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function technologies() {
        return $this->belongsToMany(Technology::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
