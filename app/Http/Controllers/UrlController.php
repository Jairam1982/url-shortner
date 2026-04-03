<?php
namespace App\Http\Controllers;

use App\Models\Urls;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function create()
    {
        return view('urls.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'long_url' => 'required|url'
        ]);

        $shortCode = Str::random(6);

        $url = Urls::create([
            'long_url' => $request->long_url,
            'short_url' => $shortCode,
            'company_id' => auth()->user()->company_id,
            'user_id' => auth()->user()->id
        ]);

        return back()->with([
            'success' => 'Short URL generated successfully!',
            'short_url' => url('/s/'.$shortCode)
        ]);
    }

    public function redirect($short_url)
    {
        $url = Urls::where('short_url', $short_url)->first();

        // If not found
        if (!$url) {
            abort(404);
        }

        // Increment hit counter
        $url->increment('hits');

        // Redirect to original URL
        return redirect()->away($url->long_url);
    }
}