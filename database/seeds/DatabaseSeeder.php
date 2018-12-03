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

        $authors = factory(\App\Author::class, 100)->create();
        $origins = factory(\App\Origin::class, 100)->create();
        $categories = factory(\App\Category::class, 100)->create();
        $tags = factory(\App\Tag::class, 100)->create();
        $readers = factory(\App\Reader::class, 100)->create();
        for($i = 0; $i < 99; $i++) {
            $book = factory(\App\Book::class)->create([
                'author_id' => $authors->random()->id,
                'origin_id' => $origins->random()->id,
                'category_id' => $categories->random()->id
            ]);
            $book->tags()->attach($tags->random(rand(1, 3))->pluck('id')->toArray());
        }
    }
}
