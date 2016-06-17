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
        $this->click('Logout');
        $this->seePageIs('/');
        $this->see('Login');
        $this->visit('/');

    }

    /**
     * Test login
     */
    public function testlogin()
    {
        $faker = Faker\Factory::create();
        $email = $faker->safeEmail;
        $password = str_random(10);
        $name = $faker->name;
        $user = factory(App\User::class)->create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
        $this->seeInDatabase('users', ['email' => $email]);
        $this->visit('/login');
        $this->type($email, 'email');
        $this->type($password, 'password');
        $this->check('remember');
        $this->press('Login');
        $this->seePageIs('/files');
        $this->see($name);
    }
}
