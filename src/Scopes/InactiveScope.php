<?php

namespace JuniorFontenele\LaravelActivestate\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class InactiveScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where(config('activestate.column_name'), false);
    }
}
