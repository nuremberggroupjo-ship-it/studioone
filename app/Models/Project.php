<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'title_ar', 'description', 'description_ar', 'is_recent'];

    public function categories()
    {
        return $this->belongsToMany(ProjectCategory::class, 'project_category_pivot');
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class, "project_id")->where("is_primary", false);;
    }
    public function primary_image()
    {
        return $this->hasOne(ProjectImage::class, "project_id")->where("is_primary", true);
    }
}
