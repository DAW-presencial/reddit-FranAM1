<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comments;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Community;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        $fran = User::factory()->create([
            'name' => 'Fran',
            'email' => 'fran@gmail.com',
        ]);

        $jordi = User::factory()->create([
            'name' => 'Jordi',
            'email' => 'jordi@gmail.com',
        ]);

        for($i = 1; $i < 6; $i++){
            if($i % 2 == 0){
                $user = $fran;
            } else {
                $user = $jordi;
            }

            

            $community = Community::factory()->create([
                'name' => 'Test Community ' . $i,
            ]);

            $post = Post::factory(rand(1,5))->create([
                'title' => 'Test Post ' . $i,
                'content' => 'Test Post Body ' . $i,
                'user_id' => $user->id,
                'community_id' => $community->id,
            ]);
            
            foreach($post as $p){
                Comment::factory(rand(1,3))->create([
                    'content' => 'Test Comment ' . $i,
                    'user_id' => $user->id,
                    'post_id' => $p->id,
                ]);
            }
            

            $user->communities()->attach($community);
        }
    }
}
