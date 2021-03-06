<?php
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate', ['--database' => 'testing']);
        Artisan::call('db:seed');
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset', ['--database' => 'testing']);
        parent::tearDown();
    }
}
