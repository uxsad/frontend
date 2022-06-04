<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)
            ->has(Website::factory(10)->hasPages(20))
            ->create();
        foreach (User::all() as &$user){
            $user->shared_with()->attach(Website::where('user_id', '!=', $user->id)->get('id')->random(4));
        }
    }
}
