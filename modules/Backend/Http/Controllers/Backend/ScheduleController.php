<?php

namespace MojarCMS\Backend\Http\Controllers\Backend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use MojarCMS\Backend\Models\Schedule;
use MojarCMS\CMS\Http\Controllers\BackendController;

class ScheduleController extends BackendController
{
    /**
     * Get employee's schedules
     */
    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $dateFrom = $request->get('date_from', now()->startOfDay());
        $dateTo = $request->get('date_to', now()->addMonth()->endOfDay());

        $schedules = Schedule::where('user_id', $user->id)
            ->whereDate('scheduled_date', '>=', $dateFrom)
            ->whereDate('scheduled_date', '<=', $dateTo)
            ->with(['location', 'service', 'jobAssignments'])
            ->orderBy('scheduled_date', 'asc')
            ->get();

        return response()->json([
            'data' => $schedules,
            'count' => $schedules->count(),
        ]);
    }

    /**
     * Get today's schedule
     */
    public function today(): JsonResponse
    {
        $user = Auth::user();
        $today = now()->toDateString();

        $schedules = Schedule::where('user_id', $user->id)
            ->whereDate('scheduled_date', $today)
            ->with(['location', 'service', 'jobAssignments'])
            ->orderBy('start_time', 'asc')
            ->get();

        return response()->json([
            'data' => $schedules,
            'count' => $schedules->count(),
        ]);
    }

    /**
     * Get a specific schedule
     */
    public function show(Schedule $schedule): JsonResponse
    {
        // Check if user is authorized to view this schedule
        if ($schedule->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json([
            'data' => $schedule->load(['location', 'service', 'jobAssignments']),
        ]);
    }
}
