<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();
        DB::table('categories')->delete();
        DB::table('users')->delete();

        User::factory(3)->create()->each(function ($u) {
            $u->categories()
                ->saveMany(
                    Category::factory(5)->make()
                )->each(function ($c) {
                    $c->posts()->saveMany(Post::factory(5)->make());
                });
        });
    }
}
