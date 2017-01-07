<?php

use Illuminate\Database\Seeder;

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
            factory(App\User::class)->create([
                    "name" => "Oscar Duran",
                    "email" => "oscarduran@gmail.com",
                    "password" => bcrypt(env('OSCAR_PWD', '123456'))]
            );
        } catch (\Illuminate\Database\QueryException $exception) {
        }
    }
}
