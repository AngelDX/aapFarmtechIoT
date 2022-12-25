<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $posts=Post::factory(50)->create();
        foreach ($posts as $post) {
            Image::create([
                'url'=>'posts/notice.jpg',
                'imageable_id'=>$post->id,
                'imageable_type'=>Post::class
            ]);
        }
    }
}
