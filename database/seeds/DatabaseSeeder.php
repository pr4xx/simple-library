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
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('admin');
        $admin->save();

        return;

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
            if(rand(0, 5) > 3 && false) {
                $createdAt = now()->subDays(rand(0, 10));
                $lending = new \App\Lending();
                $lending->book_id = $book->id;
                $lending->reader_id = $readers->random()->id;
                $lending->due_at = $createdAt->copy()->addDays(14);
                $lending->returned_at = rand(0, 1) ? now()->addDays(rand(1, 20)) : null;
                $lending->created_at = $createdAt;
                $lending->save();
            }
        }
    }
}
