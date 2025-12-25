<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Article;
use Illuminate\Support\Str;

class ScrapeBeyondChats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrape-beyond-chats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $listUrl = 'https://beyondchats.com/blogs-2/page/14/'; 
        $html = file_get_contents($listUrl);
        $crawler = new Crawler($html);

        // Adjust selectors after inspecting the page structure
        $links = $crawler->filter('article h2 a')->each(function ($node) {
            return $node->attr('href');
        });

        $links = array_slice($links, 0, 5);

        foreach ($links as $url) {
            $this->info("Scraping: {$url}");
            $postHtml = file_get_contents($url);
            $postCrawler = new Crawler($postHtml);

            $title = $postCrawler->filter('h1')->first()->text();

            $contentNode = $postCrawler->filter('article')->first();
            $contentHtml = $contentNode->html();

            Article::updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title'       => $title,
                    'source_url'  => $url,
                    'content'     => $contentHtml,
                    'published_at'=> now(),
                ]
            );
        }

        $this->info('Scraping complete.');
    }
}
