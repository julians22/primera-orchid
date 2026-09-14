<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
        // 'title' => 'json',
        'description' => 'json',
    ];

    /**
     * Get the items for this service.
     */
    public function items(): HasMany
    {
        return $this->hasMany(ServiceItem::class)->orderBy('sort_order');
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (empty($value)) {
                    return ['en' => '', 'id' => ''];
                }

                $decoded = json_decode($value, true);

                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    return [
                        'en' => $decoded['en'] ?? '',
                        'id' => $decoded['id'] ?? '',
                    ];
                }

                return [
                    'en' => $value,
                    'id' => '',
                ];
            },

            set: fn ($value) => is_array($value) ? json_encode($value) : $value
        );
    }
}
