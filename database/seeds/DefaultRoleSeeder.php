<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\User;

class DefaultRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Admin']);
        $role = Role::create(['name' => 'Guest']);
        $user = User::create([
            'name' => 'whiterabbitadmin@yopmail.com',
            'email' => 'Qwerty123!',
            'password' => Hash::make($data['password']),
        ]);
    }
}
