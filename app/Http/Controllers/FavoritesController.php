<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;

class FavoritesController extends Controller
{
    /**
     * Create a new controller instance
     *
     * FavoritesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a new favorite in the database
     *
     * @param Reply $reply
     * @return mixed
     */
    public function store(Reply $reply)
    {
        $reply->favorite();

        return back();
    }
}
