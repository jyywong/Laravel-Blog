<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\Like;
use App\Models\Topic;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public static function likeUniqueSeeding(){
        for ($i=0;$i = 10000; $i++){
            try{
                Like::factory()->create([
                'user_id' => User::pluck('id')->random(),
                'post_id' => Post::pluck('id')->random(),
                'vote_type' => 'up'
            ]);
            }
            catch(Exception $e){
                DatabaseSeeder::likeUniqueSeeding();
            }
           }
    }
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::factory(30)->create();
        Board::factory(10)->create()->each(function($board){
            $board->topics()->saveMany(Topic::factory(10)->create()->each(function($topic){
                $op = $topic->posts()->save(Post::factory()->make(['isOP'=> true]));
                $topic->OPID = $op->id; 
                $topic->posts()->saveMany(Post::factory(7)->make(['isOP'=>false]));
            }));
        });
        
      DatabaseSeeder::likeUniqueSeeding();
        
        

    }
}
