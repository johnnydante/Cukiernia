<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = \App\Roles::where('name', 'Admin')->first();
        $user = new \App\User();
        $user->name = 'Dawid';
        $user->email = 'dante.dawid@gmail.com';
        $user->password = bcrypt('qwerty');
        $user->save();
        $user->roles()->attach($role);

       /* $user = new \App\User();
        $user->name = 'User1';
        $user->email = 'user1@example.com';
        $user->password = bcrypt('qwerty');
        $user->save();
        $user->roles()->attach(2);

        $user = new \App\User();
        $user->name = 'User2';
        $user->email = 'user2@example.com';
        $user->password = bcrypt('qwerty');
        $user->save();
        $user->roles()->attach(3);*/
    }
}
