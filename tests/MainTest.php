<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MainTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasic()
    {
        $this->visit('/')
            ->see('Welcome')
            ->dontSee('chama');
    }


    /**
     * My test implementation
     */
    public function testFollowinRegistration()
    {
        $this->visit('/');
        $this->visit('/register');
        $this->see('Register');
    }

    /**
     * Test registration
     */
    public function testRegistration()
    {
        $this->visit('/register');
        $this->type('test', 'name');
        $this->type('test@email.com', 'email');
        $this->type('1234567', 'password');
        $this->type('1234567', 'password_confirmation');
        $this->press('Register');
        $this->seePageIs('/files');
        $this->see('test');
        $this->seeInDatabase('users', ['email' => 'test@email.com']);
        $this->seeInDatabase('users', ['name' => 'test']);
    }

    /**
     * Test add file
     */
    public function testLogout()
    {
        
    }
}
