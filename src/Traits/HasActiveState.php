<?php

namespace JuniorFontenele\LaravelActivestate\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait HasActiveState
{
    public function scopeActive(Builder $query): Builder
    {
        return $query->where(config('activestate.column_name'), true);
    }

    public function scopeInactive(Builder $query): Builder
    {
        return $query->where(config('activestate.column_name'), false);
    }

    public function isActive(): bool
    {
        return $this->{config('activestate.column_name')} === true;
    }

    public function isInactive(): bool
    {
        return ! $this->isActive();
    }

    public function activate(): void
    {
        $this->{config('activestate.column_name')} = true;
        $this->save();
    }

    public function deactivate(): void
    {
        $this->{config('activestate.column_name')} = false;
        $this->save();
    }

    public function toggleActiveState(): void
    {
        $this->{config('activestate.column_name')} = ! $this->{config('activestate.column_name')};
    }
}
