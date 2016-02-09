<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run(){
        DB::table('users')->delete();

        $adminRole = Role::whereName('administrator')->first();
        $userRole = Role::whereName('user')->first();

        $user = User::create(array(
            'first_name'    => 'Administrator',
            'last_name'     => 'Account',
            'email'         => 'admin@email.com',
            'password'      => Hash::make('123456')
        ));
        $user->assignRole($adminRole);

        $user = User::create(array(
            'first_name'    => 'Some',
            'last_name'     => 'User',
            'email'         => 'some.user@email.com',
            'password'      => Hash::make('weeeeee')
        ));
        $user->assignRole($userRole);
    }
}
