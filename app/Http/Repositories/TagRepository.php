<?php

namespace App\Http\Repositories;

use App\Interfaces\TagRepositoryInterface;
use App\Models\Tag;

class TagRepository implements TagRepositoryInterface
{

    public function get()
    {
        return Tag::orderBy('id')->simplePaginate(10);
    }

    public function getById(int $tagId): ?Tag
    {
        return Tag::findOrFail($tagId);
    }

    public function delete(int $tagId): ?bool
    {
        return $this->getById($tagId)->delete();
    }

    public function create(array $attributes): Tag
    {
        return Tag::create($attributes);
    }

    public function update(): Tag
    {
        // TODO: Implement update() method.
    }
}
