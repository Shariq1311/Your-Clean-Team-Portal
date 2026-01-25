<?php

namespace MojarCMS\Backend\Http\Controllers\Backend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use MojarCMS\Backend\Models\TimeLog;
use MojarCMS\CMS\Http\Controllers\BackendController;

class TimeLogController extends BackendController
{
    /**
     * Clock in an employee
     */
    public function clockIn(Request $request): JsonResponse
    {
        $request->validate([
            'location_ip' => 'nullable|ip',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'notes' => 'nullable|string',
        ]);

        $user = Auth::user();

        // Check if employee already has an active time log
        $activeLog = TimeLog::where('user_id', $user->id)
            ->where('status', 'active')
            ->whereNull('clock_out')
            ->first();

        if ($activeLog) {
            return response()->json([
                'message' => 'You are already clocked in.',
                'data' => $activeLog,
            ], 409);
        }

        $timeLog = TimeLog::create([
            'user_id' => $user->id,
            'clock_in' => Carbon::now(),
            'status' => 'active',
            'location_ip' => $request->location_ip ?: $request->ip(),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'notes' => $request->notes,
        ]);

        return response()->json([
            'message' => 'Clocked in successfully.',
            'data' => $timeLog,
        ], 201);
    }

    /**
     * Clock out an employee
     */
    public function clockOut(Request $request): JsonResponse
    {
        $user = Auth::user();

        $activeLog = TimeLog::where('user_id', $user->id)
            ->where('status', 'active')
            ->whereNull('clock_out')
            ->first();

        if (!$activeLog) {
            return response()->json([
                'message' => 'No active clock in found.',
            ], 404);
        }

        $clockOutTime = Carbon::now();
        $hoursWorked = round($clockOutTime->diffInMinutes($activeLog->clock_in) / 60, 2);

        $activeLog->update([
            'clock_out' => $clockOutTime,
            'hours_worked' => $hoursWorked,
            'status' => 'completed',
            'notes' => ($activeLog->notes ? $activeLog->notes . ' | ' : '') . ($request->notes ?: ''),
        ]);

        return response()->json([
            'message' => 'Clocked out successfully.',
            'data' => $activeLog,
        ]);
    }

    /**
     * Get current clock in status
     */
    public function getCurrentStatus(): JsonResponse
    {
        $user = Auth::user();

        $activeLog = TimeLog::where('user_id', $user->id)
            ->where('status', 'active')
            ->whereNull('clock_out')
            ->first();

        if (!$activeLog) {
            return response()->json([
                'clocked_in' => false,
                'message' => 'Not clocked in',
            ]);
        }

        $minutesElapsed = now()->diffInMinutes($activeLog->clock_in);
        $hoursElapsed = intdiv($minutesElapsed, 60);
        $minutesRemainder = $minutesElapsed % 60;

        return response()->json([
            'clocked_in' => true,
            'clock_in_time' => $activeLog->clock_in,
            'hours_elapsed' => $hoursElapsed,
            'minutes_elapsed' => $minutesRemainder,
            'total_minutes' => $minutesElapsed,
            'data' => $activeLog,
        ]);
    }

    /**
     * Get time logs for a user
     */
    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $perPage = $request->get('per_page', 20);
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $query = TimeLog::where('user_id', $user->id);

        if ($dateFrom) {
            $query->where('clock_in', '>=', Carbon::parse($dateFrom)->startOfDay());
        }

        if ($dateTo) {
            $query->where('clock_in', '<=', Carbon::parse($dateTo)->endOfDay());
        }

        $timeLogs = $query->orderBy('clock_in', 'desc')->paginate($perPage);

        return response()->json($timeLogs);
    }

    /**
     * Get time log statistics
     */
    public function statistics(Request $request): JsonResponse
    {
        $user = Auth::user();
        $dateFrom = $request->get('date_from', now()->startOfMonth());
        $dateTo = $request->get('date_to', now()->endOfMonth());

        $dateFrom = Carbon::parse($dateFrom)->startOfDay();
        $dateTo = Carbon::parse($dateTo)->endOfDay();

        $timeLogs = TimeLog::where('user_id', $user->id)
            ->whereBetween('clock_in', [$dateFrom, $dateTo])
            ->where('status', 'completed')
            ->get();

        $totalHours = $timeLogs->sum('hours_worked');
        $totalDays = $timeLogs->count();
        $averageHours = $totalDays > 0 ? round($totalHours / $totalDays, 2) : 0;

        return response()->json([
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'total_hours' => round($totalHours, 2),
            'total_days' => $totalDays,
            'average_hours_per_day' => $averageHours,
            'estimated_earnings' => round($totalHours * ($user->hourly_rate ?? 0), 2),
        ]);
    }
}
