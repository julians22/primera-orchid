<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Article extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use HasTranslations;
    use InteractsWithMedia;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'title',
        'slug',
        'short_description',
        'body_content',
        'meta_title',
        'meta_description',
        'meta_keyword',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'body_content',
        'meta_title',
        'meta_description',
        'meta_keyword',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'title' => 'json',
        'slug' => 'json',
        'short_description' => 'json',
        'body_content' => 'json',
        'meta_title' => 'json',
        'meta_description' => 'json',
        'meta_keyword' => 'json',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->usingSeparator('-');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')->singleFile();
        $this->addMediaCollection('thumbnail_image')->singleFile();
        $this->addMediaCollection('meta_og_image')->singleFile();
    }

    public function primary_category(): BelongsToMany
    {
        // get one article category as primary category
        // for now, just return the first category
        return $this->belongsToMany(
            ArticleCategory::class,
            'article_article_category',
            'article_id',
            'article_category_id'
        )->withTimestamps()->limit(1);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            ArticleCategory::class,
            'article_article_category',
            'article_id',
            'article_category_id'
        )->withTimestamps();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            Tag::class,
            'article_tag',
            'article_id',
            'tag_id'
        )->withTimestamps();
    }

    public function stickyArticle(): HasOne
    {
        return $this->hasOne(StickyArticle::class);
    }

    public function nextArticle()
    {
        return $this->where('id', '>', $this->id)->orderBy('id', 'asc')->first();
    }

    public function previousArticle()
    {
        return $this->where('id', '<', $this->id)->orderBy('id', 'desc')->first();
    }
}
