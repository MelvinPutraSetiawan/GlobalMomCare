<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticlePicture;
use App\Models\Category;
use App\Models\Picture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class ArticlePictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $professional = Account::create([
            'name' => 'Professional',
            'email' => 'Professional@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'professional',
            'description' => $faker->sentence(),
            'address' => $faker->address(),
        ]);

        for ($i = 1; $i <= 10; $i++) {
            $category = Category::create([
                'name' => 'category' . $i,
            ]);

            $article = Article::create([
                'account_id' => $professional->id,
                'title' => $faker->sentence(),
                'content' => $faker->paragraph(),
            ]);

            ArticleCategory::create([
                'category_id' => $category->id,
                'article_id' => $article->id,
            ]);
        }
    }
}
