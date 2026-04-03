<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class SuperAdminUserController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        if($user->isSuperAdmin()) {
            $companies = Company::withCount([
                'users',
                'urls as total_urls',
            ])
            ->withSum('urls as total_hits', 'hits')
            ->paginate(10);

             return view('super-admin.dashboard', compact('companies'));
        }
    }
}
