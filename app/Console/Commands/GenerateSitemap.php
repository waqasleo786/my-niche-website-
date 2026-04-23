<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature   = 'sitemap:generate';
    protected $description = 'Generate the sitemap.xml file';

    public function handle(): int
    {
        $sitemap = Sitemap::create();

        $staticPages = [
            ['url' => route('home'),     'priority' => 1.0, 'changefreq' => Url::CHANGE_FREQUENCY_DAILY],
            ['url' => route('shop'),     'priority' => 0.9, 'changefreq' => Url::CHANGE_FREQUENCY_DAILY],
            ['url' => route('about'),    'priority' => 0.6, 'changefreq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['url' => route('contact'),  'priority' => 0.6, 'changefreq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['url' => route('faq'),      'priority' => 0.5, 'changefreq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['url' => route('shipping'), 'priority' => 0.5, 'changefreq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['url' => route('terms'),    'priority' => 0.3, 'changefreq' => Url::CHANGE_FREQUENCY_YEARLY],
            ['url' => route('privacy'),  'priority' => 0.3, 'changefreq' => Url::CHANGE_FREQUENCY_YEARLY],
        ];

        foreach ($staticPages as $page) {
            $sitemap->add(
                Url::create($page['url'])
                    ->setPriority($page['priority'])
                    ->setChangeFrequency($page['changefreq'])
            );
        }

        Category::active()->get()->each(function (Category $category) use ($sitemap): void {
            $sitemap->add(
                Url::create(route('shop', ['category' => $category->slug]))
                    ->setPriority(0.8)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setLastModificationDate($category->updated_at)
            );
        });

        Product::active()->get()->each(function (Product $product) use ($sitemap): void {
            $url = Url::create(route('products.show', $product->slug))
                ->setPriority(0.7)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setLastModificationDate($product->updated_at);

            if ($product->hasMedia('images')) {
                $url->addImage(
                    $product->getFirstMediaUrl('images', 'card'),
                    $product->name
                );
            }

            $sitemap->add($url);
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated: public/sitemap.xml');

        return self::SUCCESS;
    }
}
