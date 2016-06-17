<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MainTest extends TestCase
{
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
}
