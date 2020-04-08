<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $user = new User;
        $user->name = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = Hash::make('123456');
        $user->save();
        $user->roles()->attach(Role::where('name', 'admin')->first());

        
        $user = new User;
        $user->name = 'vendedor';
        $user->email = 'vendedor@vendedor.com';
        $user->password = Hash::make('123456');
        $user->save();
        $user->roles()->attach(Role::where('name', 'vendedor')->first());

    }
}