<?php

namespace App\Http\Repositories;

use App\Http\Filters\GetArticlesFilter;
use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;

class ArticleRepository implements ArticleRepositoryInterface
{

    public function get(GetArticlesFilter $filter):? Builder
    {
        return Article::filter($filter);
    }

    public function getById(int $articleId): ?Article
    {
        return Article::findOrFail($articleId);
    }

    public function delete(int $articleId): ?bool
    {
        return $this->getById($articleId)->delete();
    }

    public function create(array $attributes): Article
    {
        if (!empty($attributes['tags'])) {
            $tags = $attributes['tags'];
            unset($attributes['tags']);
        }
        $article = Article::create($attributes);
        if (!empty($tags)) {
            foreach ($tags as $tag) {
                $article->tags()->attach($tag, ['weight' => 0, 'author' => $article->author]);
            }
        }
        return $article->fresh(['tags']);
    }

    public function update(): Article
    {
        // TODO: Implement update() method.
    }
}
