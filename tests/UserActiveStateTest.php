<?php

namespace JuniorFontenele\LaravelActivestate\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use JuniorFontenele\LaravelActivestate\Scopes\ActiveScope;
use JuniorFontenele\LaravelActivestate\Scopes\InactiveScope;
use Orchestra\Testbench\Attributes\WithMigration;
use Orchestra\Testbench\TestCase;
use Workbench\App\Models\User;

use function Orchestra\Testbench\workbench_path;

#[WithMigration]
class UserActiveStateTest extends TestCase
{
    use RefreshDatabase;

    protected $enablesPackageDiscoveries = true;

    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(
            workbench_path('database/migrations')
        );
    }

    public function test_it_will_filter_users_by_active_state_using_local_scope()
    {
        $activeUsers = rand(1, 10);
        $inactiveUsers = rand(1, 10);
        $this->createActiveUser($activeUsers);
        $this->createInactiveUser($inactiveUsers);

        $this->assertEquals(User::active()->count(), $activeUsers);
        $this->assertEquals(User::inactive()->count(), $inactiveUsers);
        $this->assertEquals(User::count(), $activeUsers + $inactiveUsers);
    }

    public function test_it_will_show_active_users_using_global_scope()
    {
        $activeUsers = rand(1, 10);
        $inactiveUsers = rand(1, 10);
        $this->createActiveUser($activeUsers);
        $this->createInactiveUser($inactiveUsers);

        $this->assertEquals(User::count(), $activeUsers + $inactiveUsers);
        $this->assertEquals(User::withGlobalScope('active', new ActiveScope())->count(), $activeUsers);
        $this->assertEquals(User::withGlobalScope('inactive', new InactiveScope())->count(), $inactiveUsers);
    }

    private function createActiveUser(int $count = 1)
    {
        User::factory($count)->active()->create();
    }

    private function createInactiveUser(int $count = 1)
    {
        User::factory($count)->inactive()->create();
    }
}
