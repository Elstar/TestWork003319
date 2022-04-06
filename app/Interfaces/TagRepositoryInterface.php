<?php

namespace App\Interfaces;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

interface TagRepositoryInterface
{
    public function get();
    public function getById(int $tagId):? Tag;
    public function delete(int $tagId);
    public function create(array $attributes): Tag;
    public function update(): Tag;
}
