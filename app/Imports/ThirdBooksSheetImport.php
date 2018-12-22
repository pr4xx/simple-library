<?php

namespace App\Imports;

use App\Author;
use App\Book;
use App\Category;
use App\Origin;
use App\Tag;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ThirdBooksSheetImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $firstRow = true;
        foreach ($collection as $row) {
            if($firstRow) {
                $firstRow = false;
                continue;
            }

            // Extract values
            [
                $signature,
                $tag1Title,
                $tag2Title,
                $tag3Title,
                $authorName,
                $authorNotes,
                $title,
                $originalTitle,
                $translatedTitle,
                $originAndYear,
                $notes,
                $categoryTitle
            ] = $row->map('trim');

            if(count($exploded = explode(' ', $originAndYear)) === 2) {
                [$originTitle, $year] = $exploded;
            } else {
                $originTitle = null;
                $year = null;
            }

            if(!$signature && !$title) {
                continue;
            }

            if(!$signature) {
                $signature = 'Unbekannt ' . substr(md5($title), 0, 8);
            }

            // Create models
            Author::unguard();
            $author = $authorName ? Author::firstOrCreate([
                'name' => $authorName
            ], [
                'notes' => $authorNotes
            ]) : null;

            Origin::unguard();
            $origin = $originTitle ? Origin::firstOrCreate([
                'title' => $originTitle
            ]) : null;

            Category::unguard();
            $category = (trim($categoryTitle) !== '' && $categoryTitle !== null) ? Category::firstOrCreate([
                'title' => $categoryTitle
            ]) : null;

            Tag::unguard();
            $tag1 = $tag1Title ? Tag::firstOrCreate([
                'title' => $tag1Title
            ]) : null;
            $tag2 = $tag2Title ? Tag::firstOrCreate([
                'title' => $tag2Title
            ]) : null;
            $tag3 = $tag3Title ? Tag::firstOrCreate([
                'title' => $tag3Title
            ]) : null;
            $tagIds = [];
            if($tag1) {
                $tagIds[] = $tag1->id;
            }
            if($tag2) {
                $tagIds[] = $tag2->id;
            }
            if($tag3) {
                $tagIds[] = $tag3->id;
            }

            Book::unguard();
            $book = Book::firstOrCreate([
                'signature' => $signature
            ], [
                'title' => $title,
                'original_title' => $originalTitle,
                'translated_title' => $translatedTitle,
                'year' => $year,
                'notes' => $notes,
                'author_id' => optional($author)->id,
                'origin_id' => optional($origin)->id,
                'category_id' => optional($category)->id,
            ]);
            $book->tags()->sync($tagIds);
        }
    }
}
