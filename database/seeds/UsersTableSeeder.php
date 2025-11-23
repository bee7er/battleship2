<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        $user = new User();
        $user->name = 'System';
        $user->email = 'system@gmail.com';
        $user->password = Hash::make('battle202');
        $user->user_token = User::getNewToken();
        $user->admin = true;
        $user->save();

        $user = new User();
        $user->name = 'Brian';
        $user->email = 'brian@gmail.com';
        $user->password = Hash::make('battle101');
        $user->user_token = User::getNewToken();
        $user->admin = true;
        $user->save();

        $user = new User();
        $user->name = 'Steve';
        $user->email = 'steve@gmail.com';
        $user->password = Hash::make('battle101');
        $user->user_token = User::getNewToken();
        $user->admin = false;
        $user->save();

        $user = new User();
        $user->name = 'Phil';
        $user->email = 'phil@gmail.com';
        $user->password = Hash::make('battle101');
        $user->user_token = User::getNewToken();
        $user->admin = false;
        $user->save();

        $user = new User();
        $user->name = 'Andrew';
        $user->email = 'andrew@gmail.com';
        $user->password = Hash::make('battle101');
        $user->user_token = User::getNewToken();
        $user->admin = false;
        $user->save();

        $user = new User();
        $user->name = 'Greg';
        $user->email = 'greg@gmail.com';
        $user->password = Hash::make('battle101');
        $user->user_token = User::getNewToken();
        $user->admin = false;
        $user->save();

        $user = new User();
        $user->name = 'Tim';
        $user->email = 'tim@gmail.com';
        $user->password = Hash::make('battle101');
        $user->user_token = User::getNewToken();
        $user->admin = false;
        $user->save();

        $user = new User();
        $user->name = 'Ben';
        $user->email = 'ben@gmail.com';
        $user->password = Hash::make('battle101');
        $user->user_token = User::getNewToken();
        $user->admin = false;
        $user->save();

        $user = new User();
        $user->name = 'Russ';
        $user->email = 'russ@gmail.com';
        $user->password = Hash::make('battle101');
        $user->user_token = User::getNewToken();
        $user->admin = false;
        $user->save();

        $user = new User();
        $user->name = 'Kika';
        $user->email = 'kika@gmail.com';
        $user->password = Hash::make('battle101');
        $user->user_token = User::getNewToken();
        $user->admin = false;
        $user->save();

        $user = new User();
        $user->name = 'Ayndie';
        $user->email = 'ayndie@gmail.com';
        $user->password = Hash::make('battle101');
        $user->user_token = User::getNewToken();
        $user->admin = false;
        $user->save();

        $user = new User();
        $user->name = 'Ray';
        $user->email = 'ray@gmail.com';
        $user->password = Hash::make('battle101');
        $user->user_token = User::getNewToken();
        $user->admin = false;
        $user->save();

        $user = new User();
        $user->name = 'Leo';
        $user->email = 'leo@gmail.com';
        $user->password = Hash::make('battle101');
        $user->user_token = User::getNewToken();
        $user->admin = false;
        $user->save();

    }

}
