<?php

namespace App\Console\Commands;

use App\Feed;
use App\Website;
use Illuminate\Console\Command;

class FeedRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new feed entries';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line("Feed is running");

        $websites = Website::all();

        $bar = $this->output->createProgressBar(count($websites));

        foreach ($websites as $website) {
            if ($website->type_of_feed == 'rss') {
                try {
                    $rss = \Feed::loadRss($website->feed_url);
                    // retrieve the data and store in the feed database // loop through the items
                    foreach ($rss->item as $item) {
                        // Skips current iteration if it exists
                        if (count(Feed::select('*')->where('post_url', $item->link)->get())) { continue; }

                        if (isset($item->{'content:encoded'})) {
                            $content = $item->{'content:encoded'};
                        } else {
                            $content = $item->description;
                        }

                        $feed = Feed::create([
                            'website_id'    => $website->id,
                            'category_id'   => $website->category->id,
                            'post_title'    => $item->title,
                            'post_url'      => $item->link,
                            'pub_date'      => date('Y-m-d h:i:s' ,(int) $item->timestamp),
                            'post_content'  => $content,
                            'post_id'       => $item->guid,
                            'post_picture'  => null,
                        ]);
                    }

                } catch (\Exception $e) {
                    return $this->error("\nFeed not working \n" . $e);

                }
            } elseif ($website->type_of_feed == 'atom') {
                $this->error("\nAtom Feed Not Supported. Check back later");

            } else {
                $this->error("\nInvalid Feed Type");

            }
            
            $bar->advance();
        }
        $bar->finish();
        return $this->info("\nSuccessfully added the Feed ". env("APP_URL"). "/feed");
    }
}
