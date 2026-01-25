<?php

namespace MojarCMS\Backend\Policies;

use MojarCMS\CMS\Models\User;

class IsAdminPolicy
{
    /**
     * Determine if user is admin
     */
    public function admin(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if user can manage employees
     */
    public function manageEmployees(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if user can manage payroll
     */
    public function managePayroll(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if user can view time tracking
     */
    public function viewTimeTracking(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if user can generate reports
     */
    public function generateReports(User $user): bool
    {
        return $user->isAdmin();
    }
}
