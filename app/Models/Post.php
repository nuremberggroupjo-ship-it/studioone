<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'small_header',
        'small_header_ar',
        'name',
        'name_ar',
        'description',
        'description_ar',
        'button_name',
        'button_name_ar',
        'button_link',
        'button_link_ar',
        'image_path',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = \Str::slug($post->name);
            }
        });
    }
}
