# Step 6: Authorization & Role-Based Access Control - Complete

**Status**: ✅ COMPLETE

## Overview
Step 6 implements comprehensive role-based authorization and access control for the employee portal and admin dashboard. This ensures:
- Admins have full access to all endpoints
- Employees can only access their own data
- Non-authenticated users are redirected
- Unauthorized access attempts are blocked with 403 errors

## Implementation Details

### 1. Authorization Policies Created

#### IsAdminPolicy (`modules/Backend/Policies/IsAdminPolicy.php`)
Handles admin-level authorization checks:
- `admin()` - Verifies user is admin
- `manageEmployees()` - Admin only
- `managePayroll()` - Admin only
- `viewTimeTracking()` - Admin only
- `generateReports()` - Admin only

#### EmployeeDataPolicy (`modules/Backend/Policies/EmployeeDataPolicy.php`)
Handles employee data access control:
- `viewOwn()` - Employees see own data, admins see all
- `viewTimeLogs()` - Employees see own logs, admins see all
- `viewSchedule()` - Employees see own schedule, admins see all
- `update()` - Admins only
- `delete()` - Admins only
- `viewPayroll()` - Employees see own payroll, admins see all

### 2. Middleware Created

#### CheckAdmin Middleware (`modules/Backend/Http/Middleware/CheckAdmin.php`)
- Ensures user is authenticated
- Verifies user is admin using `is_admin()` helper
- Throws `AuthorizationException` (403) if unauthorized
- Registered as `check.admin` alias in Kernel

#### EmployeeDataAccess Middleware (`modules/Backend/Http/Middleware/EmployeeDataAccess.php`)
- Ensures user is authenticated
- Allows admins full access
- Restricts employees to their own data (checks route `employee_id` or `id` param)
- Throws `AuthorizationException` (403) if accessing other's data
- Registered as `employee.access` alias in Kernel

### 3. Kernel Middleware Registration
**File**: `modules/CMS/Http/Kernel.php`

Added to `$middlewareAliases`:
```php
'check.admin' => \Your Clean TeamCMS\Backend\Http\Middleware\CheckAdmin::class,
'employee.access' => \Your Clean TeamCMS\Backend\Http\Middleware\EmployeeDataAccess::class,
```

### 4. Authorization Gates & Policies Registered
**File**: `modules/Backend/Providers/AuthServiceProvider.php`

#### Policies Array
```php
protected $policies = [
    Post::class => PostPolicy::class,
    Taxonomy::class => TaxonomyPolicy::class,
    User::class => UserPolicy::class,
    'IsAdmin' => IsAdminPolicy::class,
    'EmployeeData' => EmployeeDataPolicy::class,
];
```

#### Gates Defined
```php
Gate::before() - Auto-pass all gates for admins
Gate::define('admin') - Check if admin
Gate::define('manage-employees') - Check if admin
Gate::define('manage-payroll') - Check if admin
Gate::define('view-time-tracking') - Check if admin
Gate::define('generate-reports') - Check if admin
```

### 5. Controller Authorization Updates

#### EmployeeController (`modules/Backend/Http/Controllers/Backend/EmployeeController.php`)
- `index()` - `$this->authorize('manage-employees')`
- `show()` - `$this->authorize('viewTimeLogs', $employee)`
- `update()` - `$this->authorize('manage-employees')`
- `destroy()` - `$this->authorize('manage-employees')`
- `statistics()` - `$this->authorize('viewTimeLogs', $employee)`
- `bulkUpdateStatus()` - `$this->authorize('manage-employees')`

#### PayrollController (`modules/Backend/Http/Controllers/Backend/PayrollController.php`)
- `summary()` - `$this->authorize('manage-payroll')`
- `employeePayroll()` - `$this->authorize('viewPayroll', $employee)`
- `timeTrackingOverview()` - `$this->authorize('view-time-tracking')`
- `generateReport()` - `$this->authorize('generate-reports')`

## Authorization Flow

### Admin User Access
1. User logs in with admin account (`is_admin = 1`)
2. Admin middleware checks: `is_admin()` returns true
3. Gates allow ALL authorizations
4. Full access to all endpoints and data

### Employee User Access
1. User logs in with employee account (`is_admin = 0`)
2. Admin middleware: not checked for employee routes
3. Employee policies evaluate:
   - For own data endpoints: `$user->id === $employee->id` passes
   - For admin endpoints: 403 Unauthorized thrown
4. Employee sees only their own data

### Unauthenticated Access
1. No user logged in
2. Routes protected by `auth:web` middleware
3. Redirect to login page

## Endpoint Protection Summary

### Admin-Only Endpoints (403 for non-admins)
- `GET /api/admin/employees` - List all employees
- `GET /api/admin/employees/{id}` - Employee details (policy check)
- `PUT /api/admin/employees/{id}` - Update employee
- `DELETE /api/admin/employees/{id}` - Delete employee
- `POST /api/admin/employees/bulk-status` - Bulk update status
- `GET /api/admin/payroll/summary` - Payroll summary
- `GET /api/admin/payroll/overview` - Time tracking overview
- `POST /api/admin/payroll/report` - Generate report

### Employee-Access Endpoints
- `GET /api/admin/employees/{id}` - See own details, 403 for others' details
- `GET /api/admin/employees/{id}/statistics` - See own stats, 403 for others' stats
- `GET /api/admin/payroll/employee/{id}` - See own payroll, 403 for others' payroll

### Public/Auth-Only Endpoints
- `GET /app/employee/dashboard` - Any authenticated user
- `GET /app/employee/time-logs` - Any authenticated user
- `GET /app/employee/schedule` - Any authenticated user
- `GET /app/employee/statistics` - Any authenticated user

## Testing Authorization

### Test as Admin User
1. Login with admin account (where `is_admin = 1`)
2. Access admin endpoints - should work
3. View all employee data - should work
4. Access employee portal - should work

### Test as Employee User
1. Login with employee account (where `is_admin = 0`)
2. Access /api/admin/employees - should get 403
3. Access /api/admin/employees/{other_id} - should get 403
4. Access /api/admin/employees/{own_id} - should work
5. Access employee portal - should work

### Test Unauthenticated
1. Without login
2. Try accessing any protected endpoint - should redirect to login

## Security Features

✅ **Authentication**: All admin endpoints require `auth:web`
✅ **Authorization**: Gates and policies check user roles before access
✅ **Data Isolation**: Employees can only access their own records
✅ **Admin Bypass**: All checks automatically pass for admins
✅ **Exception Handling**: Unauthorized access throws 403 errors

## Configuration

No additional configuration needed. The authorization system uses:
- Existing `is_admin` database field
- Laravel's built-in `Gate` facade
- Laravel's `$this->authorize()` method
- Custom policies for fine-grained control

## Related Files Modified
- `modules/CMS/Http/Kernel.php` - Added middleware aliases
- `modules/Backend/Providers/AuthServiceProvider.php` - Added policies and gates
- `modules/Backend/Http/Controllers/Backend/EmployeeController.php` - Added authorization checks
- `modules/Backend/Http/Controllers/Backend/PayrollController.php` - Added authorization checks

## Files Created
1. `modules/Backend/Policies/IsAdminPolicy.php` (47 lines)
2. `modules/Backend/Policies/EmployeeDataPolicy.php` (79 lines)
3. `modules/Backend/Http/Middleware/CheckAdmin.php` (29 lines)
4. `modules/Backend/Http/Middleware/EmployeeDataAccess.php` (38 lines)

## Next Steps
- **Step 7**: Branding & theming (customize colors, logos, navigation)
- **Optional**: Add audit logging to track authorization checks
- **Optional**: Implement time-based role restrictions
- **Optional**: Add session management and logout capabilities

## Code Quality
✅ All files error-free
✅ Follows Laravel conventions
✅ Proper namespace usage
✅ Type hints and docstrings included
✅ DRY principle with reusable policies
