<?php

use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
  
    public function run()
    {
        Role::create([
            'name'=> 'Admin',
            'slug'=> 'admin',
            'special'=> 'all-access',
        ]);

        $user= User::create([
            'name'=>'Victor',
            'email'=>'victorbayon3@gmail.com',
            'password'=>Hash::make('victor12345'),
           
        ]);

        $user->roles()->sync(1);
    }
}
