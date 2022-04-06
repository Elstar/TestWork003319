<?php

namespace App\Http\Filters;

use App\Http\Requests\ArticleGetRequest;

class GetArticlesFilter extends QueryFilter
{

    protected string $orderBy = 'id';

    public function __construct(ArticleGetRequest $request)
    {
        parent::__construct($request);
    }

    public function name(?string $name)
    {
        $this->builder->where('name', 'like', "%$name%");
    }

    public function author(?string $author)
    {
        $this->builder->where('author', 'like', "%$author%");
    }

    public function published(?bool $published)
    {
        $this->builder->where('published', $published);
    }

    public function rating_more(int $rating)
    {
        $this->builder->where('rating', '>=', $rating);
    }

    public function rating_less(int $rating)
    {
        $this->builder->where('rating', '<=', $rating);
    }

    public function order_by(string $order_by)
    {
        if ($this->request->has('sort_type')) {
            $this->orderBy = $order_by;
        } else {
            $this->builder->orderBy($order_by);
        }
    }

    public function sort_type(string $sort_type)
    {
        $this->builder->orderBy($this->orderBy, $sort_type);
    }

    public function relation_weight(int $weight)
    {
        $this->builder->whereHas('tags', function ($query) use ($weight) {
            $query->where('weight', $weight);
        });
    }

    public function relation_author(string $author)
    {
        $this->builder->whereHas('tags', function ($query) use ($author) {
            $query->where('author', $author);
        });
    }
}
