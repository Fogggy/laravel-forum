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

    /**
     * Apply the filters.
     *
     * @param  Builder $builder
     * @return Builder
     */
    public function apply($builder)
    {
        $this->builder = $builder;
        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
        return $this->builder;
    }
    /**
     * Fetch all relevant filters from the request.
     *
     * @return array
     */
    public function getFilters()
    {
        return $this->request->intersect($this->filters);
    }
}