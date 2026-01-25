<?php

namespace MojarCMS\Backend\Http\Controllers\Backend;

use MojarCMS\CMS\Http\Controllers\Controller;
use MojarCMS\CMS\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Get all employees with their basic info
     */
    public function index()
    {
        // Authorize admin access
        $this->authorize('manage-employees');

        $employees = User::where('role_id', '!=', 1) // Exclude admins
            ->select('id', 'name', 'email', 'phone', 'employee_id', 'position', 'hire_date', 'hourly_rate', 'created_at')
            ->orderBy('name')
            ->get();

        return response()->json($employees);
    }

    /**
     * Get detailed employee info with time logs
     */
    public function show($id)
    {
        // Get the employee
        $employee = User::findOrFail($id);

        // Authorize: admins can view all, employees can view their own
        $this->authorize('viewTimeLogs', $employee);

        $employee->load(['timeLogs' => function ($query) {
            $query->latest()->limit(30);
        }]);

        if ($employee->role_id == 1) {
            return response()->json(['message' => 'Cannot view admin details'], 403);
        }

        return response()->json($employee);
    }

    /**
     * Update employee information
     */
    public function update(Request $request, $id)
    {
        // Authorize admin access only
        $this->authorize('manage-employees');

        $employee = User::findOrFail($id);

        if ($employee->role_id == 1) {
            return response()->json(['message' => 'Cannot update admin user'], 403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:app_users,email,' . $id,
            'phone' => 'sometimes|string|max:20',
            'position' => 'sometimes|string|max:255',
            'hourly_rate' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|in:active,inactive',
        ]);

        $employee->update($validated);

        return response()->json([
            'message' => 'Employee updated successfully',
            'employee' => $employee,
        ]);
    }

    /**
     * Delete employee
     */
    public function destroy($id)
    {
        // Authorize admin access only
        $this->authorize('manage-employees');

        $employee = User::findOrFail($id);

        if ($employee->role_id == 1) {
            return response()->json(['message' => 'Cannot delete admin user'], 403);
        }

        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully']);
    }

    /**
     * Get employee statistics
     */
    public function statistics($id)
    {
        $employee = User::findOrFail($id);

        // Authorize: admins can view all, employees can view their own
        $this->authorize('viewTimeLogs', $employee);

        if ($employee->role_id == 1) {
            return response()->json(['message' => 'Cannot view admin statistics'], 403);
        }

        $currentMonth = now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = now()->endOfMonth()->format('Y-m-d');

        $timeLogs = $employee->timeLogs()
            ->whereBetween('clock_in_time', [$currentMonth, $endOfMonth])
            ->get();

        $totalHours = $timeLogs->sum('hours_worked');
        $totalDays = $timeLogs->groupBy('clock_in_time')->count();
        $estimatedEarnings = $totalHours * ($employee->hourly_rate ?? 15);

        return response()->json([
            'employee_id' => $employee->id,
            'employee_name' => $employee->name,
            'total_hours' => $totalHours,
            'total_days' => $totalDays,
            'average_hours_per_day' => $totalDays > 0 ? round($totalHours / $totalDays, 2) : 0,
            'hourly_rate' => $employee->hourly_rate,
            'estimated_earnings' => round($estimatedEarnings, 2),
            'period' => "Current Month ({$currentMonth} to {$endOfMonth})",
        ]);
    }

    /**
     * Bulk update employee status
     */
    public function bulkUpdateStatus(Request $request)
    {
        // Authorize admin access only
        $this->authorize('manage-employees');

        $validated = $request->validate([
            'employee_ids' => 'required|array',
            'status' => 'required|in:active,inactive',
        ]);

        User::whereIn('id', $validated['employee_ids'])
            ->where('role_id', '!=', 1)
            ->update(['status' => $validated['status']]);

        return response()->json(['message' => 'Employee status updated successfully']);
    }
}
