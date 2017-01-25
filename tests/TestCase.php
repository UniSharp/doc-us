<?php

namespace Tests;

use Closure;
use Mockery as m;
use CreateUsersTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Capsule\Manager;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        $this->setMocks();
    }

    public function tearDown()
    {
        m::close();
    }

    protected function setMocks()
    {
        $app = m::mock(Container::class);
        $app->shouldReceive('instance');

        DB::setFacadeApplication($app);
        DB::swap(Manager::connection());
    }
}
