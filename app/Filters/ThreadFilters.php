<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\User;

class ThreadFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['by', 'popular'];

    /**
     * Filter the query by a given username.
     *
     * @param string $username
     * @return $this
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->first();

        return $this->builder->where('user_id', $user->id);
    }

    /**
     * Filter by query according to most popular threads.
     *
     * @return mixed
     */
    protected function popular()
    {
        $this->builder->getQuery()->orders = [];

        return $this->builder->orderBy('replies_count', 'desc');
    }

}