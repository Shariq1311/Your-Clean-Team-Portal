<?php

namespace MojarCMS\Backend\Http\Controllers\Backend;

use MojarCMS\CMS\Http\Controllers\Controller;
use MojarCMS\CMS\Models\User;
use MojarCMS\Backend\Models\TimeLog;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Get payroll summary for a date range
     */
    public function summary(Request $request)
    {
        // Authorize admin access only
        $this->authorize('manage-payroll');

        $dateFrom = $request->query('date_from', now()->startOfMonth()->format('Y-m-d'));
        $dateTo = $request->query('date_to', now()->format('Y-m-d'));

        // Get all employees with their time logs for the period
        $employees = User::where('role_id', '!=', 1)
            ->with(['timeLogs' => function ($query) use ($dateFrom, $dateTo) {
                $query->whereBetween('clock_in_time', [$dateFrom, $dateTo]);
            }])
            ->get();

        $payrollData = [];
        $totalPayroll = 0;

        foreach ($employees as $employee) {
            $hoursWorked = $employee->timeLogs->sum('hours_worked');
            $hourlyRate = $employee->hourly_rate ?? 15;
            $totalEarnings = $hoursWorked * $hourlyRate;

            $payrollData[] = [
                'employee_id' => $employee->id,
                'employee_name' => $employee->name,
                'position' => $employee->position,
                'hours_worked' => round($hoursWorked, 2),
                'hourly_rate' => $hourlyRate,
                'total_earnings' => round($totalEarnings, 2),
                'days_worked' => $employee->timeLogs->groupBy('clock_in_time')->count(),
            ];

            $totalPayroll += $totalEarnings;
        }

        return response()->json([
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'payroll_data' => $payrollData,
            'total_payroll' => round($totalPayroll, 2),
            'total_employees' => count($employees),
            'average_pay_per_employee' => count($employees) > 0 ? round($totalPayroll / count($employees), 2) : 0,
        ]);
    }

    /**
     * Get payroll report for a specific employee
     */
    public function employeePayroll($employeeId, Request $request)
    {
        $employee = User::findOrFail($employeeId);

        // Authorize: admins can view all, employees can view their own
        $this->authorize('viewPayroll', $employee);

        $dateFrom = $request->query('date_from', now()->startOfMonth()->format('Y-m-d'));
        $dateTo = $request->query('date_to', now()->format('Y-m-d'));

        if ($employee->role_id == 1) {
            return response()->json(['message' => 'Cannot view admin payroll'], 403);
        }

        $timeLogs = $employee->timeLogs()
            ->whereBetween('clock_in_time', [$dateFrom, $dateTo])
            ->orderBy('clock_in_time')
            ->get();

        $totalHours = $timeLogs->sum('hours_worked');
        $hourlyRate = $employee->hourly_rate ?? 15;
        $totalEarnings = $totalHours * $hourlyRate;

        return response()->json([
            'employee_id' => $employee->id,
            'employee_name' => $employee->name,
            'employee_email' => $employee->email,
            'position' => $employee->position,
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'time_logs' => $timeLogs->map(function ($log) {
                return [
                    'id' => $log->id,
                    'date' => $log->clock_in_time,
                    'clock_in' => $log->clock_in_time,
                    'clock_out' => $log->clock_out_time,
                    'hours' => round($log->hours_worked, 2),
                ];
            }),
            'total_hours' => round($totalHours, 2),
            'total_days' => $timeLogs->groupBy('clock_in_time')->count(),
            'hourly_rate' => $hourlyRate,
            'total_earnings' => round($totalEarnings, 2),
        ]);
    }

    /**
     * Get comprehensive time tracking overview
     */
    public function timeTrackingOverview(Request $request)
    {
        // Authorize admin access only
        $this->authorize('view-time-tracking');

        $dateFrom = $request->query('date_from', now()->startOfMonth()->format('Y-m-d'));
        $dateTo = $request->query('date_to', now()->format('Y-m-d'));
        $employeeId = $request->query('employee_id');

        $query = TimeLog::whereBetween('clock_in_time', [$dateFrom, $dateTo]);

        if ($employeeId) {
            $query->where('user_id', $employeeId);
        }

        $timeLogs = $query->with('user:id,name,position')
            ->latest('clock_in_time')
            ->paginate(50);

        $totalHours = TimeLog::whereBetween('clock_in_time', [$dateFrom, $dateTo])
            ->when($employeeId, fn($q) => $q->where('user_id', $employeeId))
            ->sum('hours_worked');

        $totalDays = TimeLog::whereBetween('clock_in_time', [$dateFrom, $dateTo])
            ->when($employeeId, fn($q) => $q->where('user_id', $employeeId))
            ->distinct('user_id')
            ->count('user_id');

        return response()->json([
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'time_logs' => $timeLogs,
            'total_hours' => round($totalHours, 2),
            'employees_worked' => $totalDays,
        ]);
    }

    /**
     * Generate payroll report (can be extended for PDF/CSV export)
     */
    public function generateReport(Request $request)
    {
        // Authorize admin access only
        $this->authorize('generate-reports');

        $dateFrom = $request->query('date_from', now()->startOfMonth()->format('Y-m-d'));
        $dateTo = $request->query('date_to', now()->format('Y-m-d'));

        $summary = $this->summary(new Request(['date_from' => $dateFrom, 'date_to' => $dateTo]));

        return $summary;
    }
}
