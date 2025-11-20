<?php

namespace App\Http\Controllers;

use App\Helpers\UserAgentHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SessionHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        // Get session histories from database table 'sessions'
        $sessions = DB::table('sessions')->paginate(10);

        $sessions->getCollection()->transform(function ($session) {
            $session->user_name = User::where('id', $session->user_id)->value('name') ?? 'Guest';
            $session->browser = (UserAgentHelper::browser($session->user_agent). ' '. UserAgentHelper::browserVersion($session->user_agent)) ?? 'Unknown';
            $session->os = (UserAgentHelper::os($session->user_agent). ' '. UserAgentHelper::osVersion($session->user_agent)) ?? 'Unknown';
            $session->device = UserAgentHelper::device($session->user_agent) ?? 'Unknown';
            $session->last_activity = date('Y-m-d H:i:s', $session->last_activity);
            return $session;
        });

        return view('dashboard.admin.session-history')->with([
            'sessions' => $sessions
        ]);
    }
}
