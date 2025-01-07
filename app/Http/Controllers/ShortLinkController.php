<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
// use App\Models\ShortLink;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShortLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.shortlink', [
            'shortlinks' => ShortLink::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        // $data['title'] = Str::ucfirst($request->title);
        $data['original_url'] = $request->url;
        $data['shortened_url'] = Str::random(5);
        ShortLink::create($data);
        return redirect(route('customer.shortlink.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShortLink  $shortlink
     * @return \Illuminate\Http\Response
     */
    public function show(ShortLink $shortlink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShortLink  $shortlink
     * @return \Illuminate\Http\Response
     */
    public function edit(ShortLink $shortlink)
    {
        return view('customer.shortlink', [
            'shortlink' => $shortlink,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShortLink  $shortlink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShortLink $shortlink)
    {
        $validated = $request->validate([
            // 'title' => 'required|string|max:255',
            'original_url' => 'required|string|max:255',
        ]);
        $validated['shortened_url'] = Str::random(5);
        $shortlink->update($validated);
        return redirect(route('customer.shortlink.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShortLink  $shortlink
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShortLink $shortlink)
    {
        $shortlink->delete();
        return redirect(route('shortlinks.index'));
    }

    public function shortenLink($shortened_url)
    {
        $find = ShortLink::where('shortened_url', $shortened_url)->first();

        // Cek apakah short link ditemukan
        if (!$find) {
            // Mengembalikan error 404 jika tidak ditemukan
            abort(404, 'Shortened URL not found');
        }

        // Redirect ke original URL jika ditemukan
        return redirect($find->original_url);
    }
}
