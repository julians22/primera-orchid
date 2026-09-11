<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use HasFactory;
    use HasTranslations;

    public array $translatable = [
        'content',
    ];

    protected $fillable = [
        'avatar',
        'name',
        'location',
        'content',
        'is_active',
    ];

    protected $casts = [
        'content' => 'json',
        'is_active' => 'boolean',
    ];
}
