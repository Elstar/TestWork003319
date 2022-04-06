<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Faker\Generator;

class ArticleTagSeeder extends Seeder
{
    private Generator $faker;

    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = Article::factory()->count(10)->create();
        $tags = Tag::factory()->count(10)->create();
        foreach ($articles as $article) {
            /** @var Article $article */
            if ($this->faker->boolean) {
                $tag_ids = $tags->random($this->faker->numberBetween(1,3))->pluck('id');
                foreach ($tag_ids as $tag_id) {
                    $article->tags()->attach(
                        $tag_id,
                        [
                            'weight' => $this->faker->numberBetween(0,100),
                            'author' => $article->author
                        ]
                    );
                }
            }
        }
    }
}
