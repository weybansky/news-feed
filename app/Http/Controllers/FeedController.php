<?php

namespace App\Http\Controllers;

use App\Feed;
use App\Website;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FeedController extends Controller
{

    public function __construct(){
      $this->middleware('auth')->except(['index']);
    }

    public function index () {
        // $feeds = Feed::latest('pub_date')->get();
        $feeds = Feed::where('pub_date', '>', Carbon::today()->subDay(5))->orderBy('pub_date', 'desc')->paginate(12);
        return view('feed.index', compact('feeds'));
    }
    
    // Adds all the feed for a single website
    public function single(Website $website) {
        $website = Website::findOrFail($website->id);
        if ($website->type_of_feed == 'rss') {
            try {
                $rss = \Feed::loadRss($website->feed_url);
                // retrieve the data and store in the database // loop through the items
                dd($rss);
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
                        'pub_date'      => date('Y-m-d H:i:s' ,(int) $item->timestamp),
                        'post_content'  => $content,
                        'post_id'       => $item->guid,
                        'post_picture'  => null,
                    ]);
                }
                return "Successfully added the Feed <a href=". url("/feed"). ">View</a>";

            } catch (\Exception $e) {
                    // abort(404, 'Rss Feed Not Working');
                    abort(404, $e);
            }
        } elseif ($website->type_of_feed == 'atom') {
            abort(404, 'Atom Feed Not Supported');
            // LOL
            try {
                $atom = \Feed::loadAtom($website->feed_url);
                $entries = $atom->entry;                          dd($atom);
                    // retrieve the data and store in the database // loop through the items
                foreach ($entries as $entry) {
                        // Not sure if to validate the rss->item first (skipped for now)
                        /* From the database
                                $table->string('post_title');
                                $table->string('post_url');
                                $table->dateTime('pub_date');
                                $table->string('post_content')->nullable();
                                $table->string('post_id');  // guid
                                //
                                $table->string('post_picture')->nullable();
                        */

                        // Store the item into the feed database
                    // $feed = Feed::create([
                    //  ''
                    // ]);
                }
                    
            } catch (\Exception $e) {
                    abort(404, 'Atom Feed Not working');
            }
        } else {
            abort(404, 'Invalid Feed Type');
        }
    }


    // Add the feed for all registeres websites
    public function all () {
        $websites = Website::all();

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
                            'pub_date'      => date('Y-m-d H:i:s' ,(int) $item->timestamp),
                            'post_content'  => $content,
                            'post_id'       => $item->guid,
                            'post_picture'  => null,
                        ]);
                    }

                } catch (\Exception $e) {
                    // TODO
                    // Find a way to log the errors
                    abort(404, "Rss Feed Stopped Working");
                    // abort(404, $e);
                }
            } elseif ($website->type_of_feed == 'atom') {
                abort(404, 'Atom Feed Not Supported. Check back later');
                // LOL
                try {
                    $atom = \Feed::loadAtom($website->feed_url);
                    $entries = $atom->entry;                          dd($atom);
                        // retrieve the data and store in the database // loop through the items
                    foreach ($entries as $entry) {
                            // Not sure if to validate the rss->item first (skipped for now)
                            /* From the database
                                    $table->string('post_title');
                                    $table->string('post_url');
                                    $table->dateTime('pub_date');
                                    $table->string('post_content')->nullable();
                                    $table->string('post_id');  // guid
                                    //
                                    $table->string('post_picture')->nullable();
                            */

                            // Store the item into the feed database
                        // $feed = Feed::create([
                        //  ''
                        // ]);
                    }   
                } catch (\Exception $e) {
                        abort(404, 'Atom Feed Not working');
                }
            } else {
                abort(404, 'Invalid Feed Type');
            }
            
        }
        return "Successfully added the Feed <a href=". url("/feed"). ">View</a>";
    }


}
