<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spatie\Permission\Models\Role;

class TasksControllerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     * @group Authorized
     * @return void
     */


    public function testAuthorizedIndex()
    {
        $user =$this->login();
        Role::create(['name' => 'admin']);
        $user->assignRole('admin');

        $this->get('tasks');

        $this->assertResponseOk();
    }

    public function testNotAuthorizedIndex()
    {
        $this->login();

        $this->get('tasks');
        $this->assertRedirectedTo(403);

    }

    public function login()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user);
        return $user;
    }
}
