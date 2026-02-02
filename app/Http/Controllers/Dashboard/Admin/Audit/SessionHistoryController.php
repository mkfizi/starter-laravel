<?php

namespace App\Http\Controllers\Dashboard\Admin\Audit;

use App\Http\Controllers\Controller;
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
    public function index(Request $request) : View
    {
        // Get session histories from database table 'sessions'
        $query = DB::table('sessions');

        // Search by user email
        if ($search = $request->input('search')) {
            $userIds = User::where('email', 'like', "%{$search}%")->pluck('id');
            $query->where(function ($q) use ($userIds, $search) {
                $q->whereIn('user_id', $userIds);
                // Include guest sessions if searching for "guest"
                if (stripos('guest', strtolower($search)) !== false) {
                    $q->orWhereNull('user_id');
                }
            });
        }

        $sessions = $query->paginate(10);

        $sessions->getCollection()->transform(function ($session) {
            $session->user_email = User::where('id', $session->user_id)->value('email') ?? 'Guest';
            $session->browser = (UserAgentHelper::browser($session->user_agent). ' '. UserAgentHelper::browserVersion($session->user_agent)) ?? 'Unknown';
            $session->os = (UserAgentHelper::os($session->user_agent). ' '. UserAgentHelper::osVersion($session->user_agent)) ?? 'Unknown';
            $session->device = UserAgentHelper::device($session->user_agent) ?? 'Unknown';
            $session->last_activity = date('Y-m-d H:i:s', $session->last_activity);
            return $session;
        });

        return view('dashboard.admin.audit.session-history')->with([
            'sessions' => $sessions
        ]);
    }
}
