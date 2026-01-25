<?php

namespace MojarCMS\Backend\Policies;

use MojarCMS\CMS\Models\User;

class EmployeeDataPolicy
{
    /**
     * Determine if user can view own data
     */
    public function viewOwn(User $user, User $employee): bool
    {
        // Admins can view all employee data
        if ($user->isAdmin()) {
            return true;
        }

        // Employees can only view their own data
        return $user->id === $employee->id;
    }

    /**
     * Determine if user can view time logs
     */
    public function viewTimeLogs(User $user, User $employee): bool
    {
        // Admins can view all time logs
        if ($user->isAdmin()) {
            return true;
        }

        // Employees can only view their own time logs
        return $user->id === $employee->id;
    }

    /**
     * Determine if user can view schedule
     */
    public function viewSchedule(User $user, User $employee): bool
    {
        // Admins can view all schedules
        if ($user->isAdmin()) {
            return true;
        }

        // Employees can only view their own schedule
        return $user->id === $employee->id;
    }

    /**
     * Determine if user can update employee data
     */
    public function update(User $user, User $employee): bool
    {
        // Only admins can update employee data
        return $user->isAdmin();
    }

    /**
     * Determine if user can delete employee
     */
    public function delete(User $user, User $employee): bool
    {
        // Only admins can delete employees
        return $user->isAdmin();
    }

    /**
     * Determine if user can view payroll
     */
    public function viewPayroll(User $user, User $employee): bool
    {
        // Admins can view all payroll data
        if ($user->isAdmin()) {
            return true;
        }

        // Employees can only view their own payroll
        return $user->id === $employee->id;
    }
}
