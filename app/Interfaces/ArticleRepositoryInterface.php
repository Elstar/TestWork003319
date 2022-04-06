<?php

namespace App\Interfaces;

use App\Http\Filters\GetArticlesFilter;
use App\Models\Article;

interface ArticleRepositoryInterface
{
    public function get(GetArticlesFilter $filter);
    public function getById(int $articleId):? Article;
    public function delete(int $articleId);
    public function create(array $attributes): Article;
    public function update(): Article;
}
