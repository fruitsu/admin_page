<?php

use App\Models\Portfolio;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;

class PortfoliosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            'lastel' => [
                'title' => [
                    'en' => 'An Irish Human Resources website'
                ],
                'body' => [

                ]
            ],
            'lagerbox' => [
                'title' => [
                    'en' => 'lagerbox'
                ],
                'body' => [
                    'en' => 'A comprehensive German self-storage ecosystem'
                ],
            ],
		];

		foreach ($pages as $slug => $page) {
			$p = Portfolio::create([
				'slug' => $slug,
				'title' => $page['title'],
				'body' => $page['body'] ?? null
			]);

			$p->metas()->create([
				'title' => $page['title'],
				'description' => ['ru' => null, 'en' => null, 'ua' => null]
			]);

			if($slug === 'lastel') {
				$p->addMedia(resource_path('images/content/portfolio/lastel/lastel-1.jpg'))->preservingOriginal()->toMediaCollection('preview');
				$p->addMedia(resource_path('images/content/portfolio/lastel/lastel-2.jpg'))->preservingOriginal()->toMediaCollection('preview');
            }

            if($slug === 'lagerbox') {
				$p->addMedia(resource_path('images/content/portfolio/lagerbox/lagerbox-1.jpg'))->preservingOriginal()->toMediaCollection('preview');
				$p->addMedia(resource_path('images/content/portfolio/lagerbox/lagerbox-2.jpg'))->preservingOriginal()->toMediaCollection('preview');
			}
		}
    }
}
