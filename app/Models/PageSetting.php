<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSetting extends Model
{
    protected $fillable = [
        'page_key',
        'section_key',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];
}