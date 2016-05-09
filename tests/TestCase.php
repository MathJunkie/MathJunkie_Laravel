<?php


class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    
    /** @test */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate',array('--force' => true));
        Artisan::call('db:seed',array('--force' => true));
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset',array('--force' => true));
        parent::tearDown();
    }
}
