<?php

namespace App\Http\Controllers;

use App\Feed;
use App\Website;
use Illuminate\Http\Request;

class FeedController extends Controller
{

    public function index () {
        $feeds = Feed::latest('pub_date')->get();

        // return Feed::first();

        return view('feed.index', compact('feeds'));
    }

    // $url = {'https://threatpost.com/feed/', 'https://www.weybanskytech.com.ng/feed', 'https://medium.com/feed/the-story', 'http://raqeebahshittu.blogspot.com/feeds/posts/default?alt=rss'}
    
    // Adds all the feed for a single website
    public function single(Website $website) {
        $website = Website::findOrFail($website->id);
        if ($website->type_of_feed == 'rss') {
            try {
                $rss = \Feed::loadRss($website->feed_url);
                // retrieve the data and store in the database // loop through the items
                foreach ($rss->item as $item) {
                    // Store the item into the feed database
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
                return "Successfully added the Feed";

            } catch (\Exception $e) {
                    // dd($e);
                    abort(404, 'Rss Feed Not Working');
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
                    // retrieve the data and store in the database // loop through the items
                    foreach ($rss->item as $item) {
                        // Store the item into the feed database
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
                    return "Successfully added the Feed";

                } catch (\Exception $e) {
                        // dd($e);
                        abort(404, 'Rss Feed Not Working');
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
    }


}
