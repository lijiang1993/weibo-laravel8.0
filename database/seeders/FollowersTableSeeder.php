<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $user = $users->first();
        $user_id = $user->id;

        //获取所用用户ID数组（不包括ID为1的用户）
        $followers = $users->slice(1);
        $follower_ids = $followers->pluck('id')->toArray();

        //ID:1 关注所有用户
        $user->follow($follower_ids);

        //所有用户关注 ID:1
        foreach ($followers as $follower) {
            $follower->follow($user_id);
        }
    }
}
