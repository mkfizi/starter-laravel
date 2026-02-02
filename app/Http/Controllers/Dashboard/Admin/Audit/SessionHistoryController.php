<?php

namespace App\Http\Controllers\Dashboard\Admin\Audit;

use App\Http\Controllers\Controller;
use App\Helpers\UserAgentHelper;
use App\Models\SessionHistory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SessionHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = SessionHistory::with('user')
            ->orderBy('login_at', 'desc');

        // Search by user email
        if ($search = $request->input('search')) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('email', 'like', "%{$search}%");
            });
        }

        $sessions = $query->paginate(10);

        $sessions->getCollection()->transform(function ($session) {
            $session->user_email = $session->user->email ?? 'Unknown';
            $session->browser = (UserAgentHelper::browser($session->user_agent) . ' ' . UserAgentHelper::browserVersion($session->user_agent)) ?: 'Unknown';
            $session->os = (UserAgentHelper::os($session->user_agent) . ' ' . UserAgentHelper::osVersion($session->user_agent)) ?: 'Unknown';
            $session->device = UserAgentHelper::device($session->user_agent) ?: 'Unknown';
            return $session;
        });

        return view('dashboard.admin.audit.session-history')->with([
            'sessions' => $sessions
        ]);
    }
}
