<?php

namespace App\Http\Controllers\Api;

use App\Http\Filters\GetArticlesFilter;
use App\Http\Requests\ArticlePostRequest;
use App\Http\Requests\ArticlePutRequest;
use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;
use App\Traits\APIResponse;
use Illuminate\Http\JsonResponse;

class ArticleController extends ApiController
{
    use APIResponse;

    private ArticleRepositoryInterface $repository;

    public function __construct(ArticleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(GetArticlesFilter $filter): JsonResponse
    {
        $articles = $this->repository->get($filter)->simplePaginate(10);

        return $this->sendResponse($articles->toArray());
    }

    public function store(ArticlePostRequest $request)
    {
        $validated = $request->validated();
        $article = $this->repository->create($validated);
        return $this->sendResponse($article->toArray());
    }


    public function show(Article $article): JsonResponse
    {
        return $this->sendResponse($article->toArray());
    }

    public function update(Article $article, ArticlePutRequest $request): JsonResponse
    {
        //todo
        return $this->sendResponse();
    }


    public function destroy(Article $article): JsonResponse
    {
        $article->delete();
        return $this->sendResponse();
    }
}
