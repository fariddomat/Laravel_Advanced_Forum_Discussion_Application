<?php

use Illuminate\Database\Seeder;

class UserstableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name'=>'Super admin',
            'password'=>bcrypt('admin'),
            'email'=>'admin@test.com',
            'admin'=>1,
            'avatar'=>asset('avatars/avatar.png')
        ]);
        App\User::create([
            'name'=>'Farid admin',
            'password'=>bcrypt('password'),
            'email'=>'admin@test.me',
            'avatar'=>asset('avatars/avatar.png')
        ]);
      
        
    }
}
