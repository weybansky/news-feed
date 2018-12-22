<?php

namespace App\Http\Controllers;

use App\Category;
use App\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $websites = Website::latest()->get();

        return view('website.index', compact('websites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'category'   => 'required',
            'name'          => 'required|min:2',
            'main_url'      => 'required|url',
            'feed_name'     => 'required|min:2',
            'feed_url'      => 'required|url',
            'type_of_feed'  => 'required',
            'icon'          => 'nullable',
        ]);

        $website = Website::create([
          'category_id' => request('category'),
          'name'        => request('name'),
          'main_url'    => request('main_url'),
          'feed_name'   => request('feed_name'),
          'feed_url'    => request('feed_url'),
          'type_of_feed'=> request('type_of_feed'),
          'icon'        => request('icon')
        ]);

        return redirect('website');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function show(Website $website, Request $request)
    {
        // dd($request->server()["HTTP_REFERER"]);
        // $url = {'https://threatpost.com/feed/', 'https://www.weybanskytech.com.ng/feed', 'https://medium.com/feed/the-story', 'http://raqeebahshittu.blogspot.com/feeds/posts/default?alt=rss'}
        $website = Website::findOrFail($website->id);
        if ($website->type_of_feed == 'rss') {
            try {
                $rss = \Feed::loadRss($website->feed_url);
                $items = $rss->item;
                dd($rss);

            } catch (\Exception $e) {
                abort(404, 'Rss Feed Not Working');
            }
        }elseif ($website->type_of_feed == 'atom') {
            try {
                $atom = \Feed::loadAtom($website->feed_url);
                $entries = $atom->entry;
                dd($atom);
                
            } catch (\Exception $e) {
                abort(404, 'Atom Feed Not working');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function edit(Website $website)
    {
        $website = Website::findOrFail($website->id);

        return view('website.edit', compact('website'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Website $website)
    {
        $this->validate(request(), [
            'category'   => 'required',
            'name'          => 'required|min:2',
            'main_url'      => 'required|url',
            'feed_name'     => 'required|min:2',
            'feed_url'      => 'required|url',
            'type_of_feed'  => 'required',
            'icon'          => 'nullable',
        ]);

        $website = Website::findOrFail($website->id);

        $website->category_id  = request('category');
        $website->name         = request('name');
        $website->main_url     = request('main_url');
        $website->feed_name    = request('feed_name');
        $website->feed_url     = request('feed_url');
        $website->type_of_feed = request('type_of_feed');
        $website->icon         = request('icon');

        $website->save();

        return redirect('website');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function destroy(Website $website)
    {
        $website = Website::findOrFail($website->id);
        $website->delete();
        return redirect('website'); 
    }
}
