<?php

namespace App\Http\Controllers;

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
