<?php

namespace Database\Seeders;

use App\Models\PersonalAccessToken;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->fill([
            'name' => 'toya',
            'uid' => Str::uuid(),
            'password' => 'password',
            'email' => 'chiba@chatplus.jp',
            'icon_url' => 'https://pbs.twimg.com/profile_images/1362640108965437445/n1SvYSbT.jpg',
        ])->save();
    }
}
