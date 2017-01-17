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
            )->each(function ($user) {
                $user->tasks()->saveMany(
                    factory(App\Task::class, 5)->create(['user_id' => $user->id])
                );
            });


        } catch (\Illuminate\Database\QueryException $exception) {
        }
    }
}
