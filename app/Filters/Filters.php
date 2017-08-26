<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 8/26/17
 * Time: 15:32
 */

namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filters
{
    protected $request, $builder;

    protected $filters = [];

    /**
     * ThreadFilters constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {

        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        $this->getFilters()
            ->filter(function ($filter) {
                return method_exists($this, $filter);
            })
            ->each(function ($filter, $value) {
                $this->$filter($value);
            });

        return $this->builder;
    }

    protected function getFilters()
    {
        return collect($this->request->intersect($this->filters))->flip();
    }
}