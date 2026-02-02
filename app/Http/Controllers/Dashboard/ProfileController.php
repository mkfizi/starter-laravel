<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile detail.
     */
    public function index(Request $request): View
    {
        return view('dashboard.profile', [
            'user' => $request->user(),
        ]);
    }
}
