<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Urls;

class AdminUserController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        if($user->isAdmin()) {
            $urls = Urls::with('user')->where('company_id', $user->company_id)
                    ->latest()
                    ->paginate(2);            
            $topUsers = Urls::select(
                'users.id',
                'users.name',
                'users.email',
                'users.role',
                DB::raw('COUNT(urls.id) as url_count'),
                DB::raw('SUM(urls.hits) as total_hits')
            )
            ->join('users', 'users.id', '=', 'urls.user_id')
            ->where('urls.company_id', $user->company_id)
            ->groupBy('users.id','users.name','users.email','users.role')
            ->orderByDesc('total_hits')
            ->orderByDesc('url_count')
            ->paginate(2);
            return view('admin.dashboard', compact('urls','topUsers'));      
        }   
        
    }

    public function adminView()
    {
        $user = auth()->user();
        $urls = Urls::with('user')->where('company_id', $user->company_id)
                    ->latest()
                    ->paginate(2);
        return view('admin.view-all-url', compact('urls'));
    }

    public function inviteForm()
    {
        return view('admin.invite');
    }

    public function sendInvite(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|in:member,admin',
        ]);

        // Send Email
        Mail::to($request->email)->send(new \App\Mail\TeamInviteMail(
            $request->name,
            $request->role
        ));

        return back()->with('success', 'Invitation sent successfully!');
    }
}
