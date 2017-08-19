<?php

function create($model, $attributes = [])
{
    return factory($model)->create($attributes);
}

function make($model, $attributes = [])
{
    return factory($model)->make($attributes);
}