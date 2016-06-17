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
        $faker = Faker\Factory::create();
        $email = $faker->safeEmail;
        $password = str_random(10);
        $name = $faker->name;

        $this->visit('/register');
        $this->type($name, 'name');
        $this->type($email, 'email');
        $this->type($password, 'password');
        $this->type($password, 'password_confirmation');
        $this->press('Register');
        $this->seePageIs('/files');
        $this->see($name);
        $this->seeInDatabase('users', ['email' => $email]);
        $this->seeInDatabase('users', ['name' => $name]);
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
