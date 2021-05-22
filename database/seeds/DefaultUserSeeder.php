<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\User;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'whiterabbitadmin',
            'email' => 'whiterabbitadmin@yopmail.com',
            'password' => Hash::make('Qwerty123!'),
        ]);
        $user->assignRole(Role::where('name','Admin')->first()->id);
    }
}
