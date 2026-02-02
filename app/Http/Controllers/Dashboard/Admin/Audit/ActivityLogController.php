<?php

namespace App\Http\Controllers\Dashboard\Admin\Audit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the activity logs.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $query = Activity::with(['causer', 'subject'])
            ->latest();

        // Search by user email/name or "system"
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                // Search for users by email or name
                $q->whereHas('causer', function ($subQuery) use ($search) {
                    $subQuery->where('email', 'like', "%$search%")
                             ->orWhere('name', 'like', "%$search%");
                });
                
                // If searching for "system", include activities without a causer
                if (stripos('system', strtolower($search)) !== false) {
                    $q->orWhereNull('causer_id');
                }
            });
        }

        // Filter by actions (multiple)
        if ($actions = $request->input('actions')) {
            $query->whereIn('description', $actions);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $activities = $query->paginate($perPage)->appends($request->only(['search', 'per_page', 'actions', 'date_from', 'date_to']));

        return view('dashboard.admin.audit.activity-log.index', compact('activities'));
    }

    /**
     * Display the specified activity log.
     */
    public function show(Activity $activity)
    {
        return view('dashboard.admin.audit.activity-log.show', compact('activity'));
    }
}
