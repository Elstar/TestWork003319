<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Eloquent;

/**
 * @mixin Eloquent
 * @mixin IdeHelperTag
 */
class Tag extends Model
{
    use HasFactory;
    use Filterable;

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_tag')->withPivot('created_at');
    }
}
