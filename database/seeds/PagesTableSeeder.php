<?php

use App\Models\Page;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            'home' => [
                'title' => [
                    'ru' => 'Строим бизнес вместе',
                    'en' => 'GROWING BUSINESSES BIT BY BIT',
                    'uk' => 'Будуємо бізнес разом'
                ]
            ],
            'design' => [
                'title' => [
                    'ru' => 'Дизайн',
                    'en' => 'Design',
                    'uk' => 'Дизайн'
                ],
                'body' => [
                    'en' => '<p>We create your unique competitive identity by deep understanding and highlighting the essence and core values of your brand.</p>'
                ]
            ],
		];

		foreach ($pages as $slug => $page) {
			$p = Page::create([
				'slug' => $slug,
				'title' => $page['title'],
				'body' => $page['body'] ?? null
			]);

			$p->metas()->create([
				'title' => $page['title'],
				'description' => ['ru' => null, 'en' => null, 'ua' => null]
			]);

			if($slug === 'design') {
				$p->addMedia(resource_path('images/content/design/design-1.jpg'))->preservingOriginal()->toMediaCollection('preview');
				$p->addMedia(resource_path('images/content/design/design-2.jpg'))->preservingOriginal()->toMediaCollection('preview');
			}
		}
    }
}

