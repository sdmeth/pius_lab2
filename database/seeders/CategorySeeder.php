<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryCount = 10;
        $categories = Category::factory($categoryCount)->create();

        foreach ($categories as $category) {
            $this->createChildCategories($category, 1, 3, $categoryCount);
        }

        $banners = Banner::all();
        Category::all()->each(function ($category) use ($banners) {
            $category->banners()->attach(
                $banners->random(rand(6, 10))->pluck('id')->toArray()
            );
        });
    }

    public function createChildCategories(Category $category, $depth, $maxDepth, &$categoryCount) 
    {
        if ($depth > $maxDepth) {
            return;
        }

        $childrencategoryCount = rand(1, 5);
        for ($i = 0; $i < $childrencategoryCount; $i++) {
            if ($categoryCount >= 100) {
                return;
            }

            $childCategory = Category::factory()->create(['parent_id' => $category->id]);
            $categoryCount++;
            $this->createChildCategories($childCategory, $depth + 1, $maxDepth, $categoryCount);
        }
    }
}
