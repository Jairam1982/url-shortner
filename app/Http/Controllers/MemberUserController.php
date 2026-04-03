<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Urls;

class MemberUserController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        
        $urls = Urls::where('company_id', $user->company_id)
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(2);
        return view('member.dashboard', compact('urls'));
    }
}
