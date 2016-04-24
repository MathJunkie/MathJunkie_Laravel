<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StartPageTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    /** @test */
    public function testStartPage()
    {
        //An unauthorized user should only see the Login page
        $this->visit('/')
            ->see('Login');
    }

    /** @test */
    public function testRedirectRegister()
    {
        //An unauthorized user should only see the Login page
        $this->visit('/login')
            ->see('Login')
            ->dontSee('Admin')
            ->click('Register Now!')
            ->see('Register')
            ->seePageIs('/register');
    }
}
