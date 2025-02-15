<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public function translations()
    {
        return $this->hasMany(SliderTranslation::class);
    }

    public function translation($language)
    {
        return $this->translations()->where('language', $language)->first();
    }
}