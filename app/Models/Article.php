<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Eloquent;

/**
 * @mixin Eloquent
 * @mixin IdeHelperArticle
 */
class Article extends Model
{
    use HasFactory;
    use Filterable;

    protected $with = ['tags'];

    protected $fillable = [
        'name',
        'author',
        'rating',
        'marks',
        'published'
    ];

    protected $casts = [
        'published' => 'boolean'
    ];

    public $timestamps = false;

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tag')
            ->as('relation')->withPivot('created_at', 'weight', 'author');
    }
}
