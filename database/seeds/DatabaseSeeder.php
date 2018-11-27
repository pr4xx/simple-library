<?php

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
        $admin = new \App\User();
        $admin->name = 'Admin';
        $admin->email = 'admin@simple-library.test';
        $admin->password = bcrypt('admin');
        $admin->save();

        $authors = factory(\App\Author::class, 10)->create();
        $origins = factory(\App\Origin::class, 10)->create();
        $categories = factory(\App\Category::class, 10)->create();
        $tags = factory(\App\Tag::class, 10)->create();
        for($i = 0; $i < 10; $i++) {
            $books = factory(\App\Book::class)->create([
                'author_id' => $authors->random()->id,
                'origin_id' => $origins->random()->id,
                'category_id' => $categories->random()->id
            ]);
        }
    }
}
