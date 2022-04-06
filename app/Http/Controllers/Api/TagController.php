<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagPostRequest;
use App\Interfaces\TagRepositoryInterface;
use App\Models\Tag;
use App\Traits\APIResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends ApiController
{
    use APIResponse;

    private TagRepositoryInterface $repository;

    public function __construct(TagRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(): JsonResponse
    {
        return $this->sendResponse($this->repository->get());
    }

    public function store(TagPostRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $tag = $this->repository->create($validated);
        return $this->sendResponse($tag->toArray());
    }

    public function show(Tag $tag): JsonResponse
    {
        return $this->sendResponse($tag->toArray());
    }

    public function update(Tag $tag, Request $request): JsonResponse
    {
        return $this->sendResponse();
    }

    public function destroy(Tag $tag): JsonResponse
    {
        $tag->delete();
        return $this->sendResponse();
    }
}
