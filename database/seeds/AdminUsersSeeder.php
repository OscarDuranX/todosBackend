<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


/**
 * Class AdminUsersSeeder
 */
class AdminUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $user = factory(App\User::class)->create([
                    "name" => "Oscar Duran",
                    "email" => "oscarduran@gmail.com",
                    "password" => bcrypt(env('OSCAR_PWD', '123456'))]
            );
            Role::create(['name' => 'admin']);
            $user->assignRole('admin');


        } catch (\Illuminate\Database\QueryException $exception) {
        }
    }
}
