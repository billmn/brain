<?php

use Illuminate\Database\Seeder;
use App\Repositories\PageRepository;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $pageRepo = app(PageRepository::class);

        $page1 = $pageRepo->create([
            'parent_id' => null,
            'status'    => 'published',
            'title'     => $faker->sentence(5),
            'content'   => implode("<br><br>", $faker->paragraphs()),
        ]);

        $page2 = $pageRepo->create([
            'parent_id' => null,
            'status'    => 'published',
            'title'     => $faker->sentence(5),
            'content'   => implode("<br><br>", $faker->paragraphs()),
        ]);

        $page3 = $pageRepo->create([
            'parent_id' => $page2->id,
            'status'    => 'published',
            'title'     => $faker->sentence(5),
            'content'   => implode("<br><br>", $faker->paragraphs()),
        ]);

        $page4 = $pageRepo->create([
            'parent_id' => $page2->id,
            'status'    => 'published',
            'title'     => $faker->sentence(5),
            'content'   => implode("<br><br>", $faker->paragraphs()),
        ]);

        $page5 = $pageRepo->create([
            'parent_id' => $page3->id,
            'status'    => 'published',
            'title'     => $faker->sentence(5),
            'content'   => implode("<br><br>", $faker->paragraphs()),
        ]);

        $page6 = $pageRepo->create([
            'parent_id' => $page5->id,
            'status'    => 'published',
            'title'     => $faker->sentence(5),
            'content'   => implode("<br><br>", $faker->paragraphs()),
        ]);
    }
}
