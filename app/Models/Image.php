<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    //
    protected $fillable = ['image', 'lang', 'is_active'];

    public function scopeLanguage($query, $language)
    {
        return $query->where('lang', $language);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            if ($model->image) {
                info($model->image);
                Storage::disk('public')->delete($model->image);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('image')) {
                if ($model->getOriginal('image') && $model->getOriginal('image') !== $model->image) {
                    info($model->image);
                    Storage::disk('public')->delete($model->getOriginal('image'));
                }
            }
        });
    }
}
