<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class ArticleCategory extends Model
{
    use HasFactory;
    use HasSlug;
    use HasTranslations;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'title',
        'slug',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'title' => 'json',
        'slug' => 'json',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->usingSeparator('-');
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(
            Article::class,
            'article_article_category',
            'article_category_id',
            'article_id'
        )->withTimestamps();
    }
}
