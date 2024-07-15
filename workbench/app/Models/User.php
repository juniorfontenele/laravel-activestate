<?php

namespace Workbench\App\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JuniorFontenele\LaravelActivestate\Traits\HasActiveState;

class User extends Model
{
    use HasActiveState;
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
    ];

    protected static function newFactory(): Factory
    {
        return \Workbench\Database\Factories\UserFactory::new();
    }
}
