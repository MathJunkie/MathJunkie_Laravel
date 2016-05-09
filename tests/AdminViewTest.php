<?php

use PHPUnit_Framework_Assert as PHPUnit;
use App\User;

class AdminViewTest extends TestCase
{
    /** @test **/
    public function testIndex(){
        $this->visit('/admin')->see("Login");

        $user = new User(array('name' => 'John'));
        $this->be($user);

        $this->visit('/admin')
             ->see("Welcome")
             ->assertViewHas('blocks');
        $this->visit('/admin')
             ->assertViewHas('scripts');
        $this->visit('/admin')
             ->assertViewHas('hasComment');
    }

}