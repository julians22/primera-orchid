<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
    ];

    protected $casts = [
        'title' => 'json',
        'description' => 'json',
    ];

    /**
     * Get the items for this service.
     */
    public function items(): HasMany
    {
        return $this->hasMany(ServiceItem::class)->orderBy('sort_order');
    }
}
