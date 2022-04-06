<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


abstract class QueryFilter
{
    protected $request;

    /**
     * @var \Illuminate\Database\Query\Builder $builder
     */
    protected $builder;

    protected $delimiter = ',';

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], [$value]);
            }
        }

        return $this->builder;
    }

    public function filters()
    {
        return $this->request->all();
    }

    public function request()
    {
        return $this->request;
    }

    protected function paramToArray($param)
    {
        return explode($this->delimiter, $param);
    }
}
