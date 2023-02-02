<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'title' => 'My First Post',
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl nec ultricies ultricies, nunc nisl aliquam nisl, nec aliquam nisl nunc vel nunc. Nullam euismod, nisl nec ultricies ultricies, nunc nisl aliquam nisl, nec aliquam nisl nunc vel nunc.',
                'body' => 'Body of my first post',
                'minutes_to_read' => 1,
                'image' => 'Empty',
                'is_published' => false,
            ],
            [
                'title' => 'My Second Post',
                'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl nec ultricies ultricies, nunc nisl aliquam nisl, nec aliquam nisl nunc vel nunc. Nullam euismod, nisl nec ultricies ultricies, nunc nisl aliquam nisl, nec aliquam nisl nunc vel nunc.',
                'body' => 'Body of my second post',
                'minutes_to_read' => 2,
                'image' => 'Empty',
                'is_published' => false,
            ]
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
