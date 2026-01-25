import React, { useState, useEffect } from 'react';
import axios from 'axios';
import BrandedNav from '@/components/BrandedNav';

interface DashboardMetrics {
  total_employees: number;
  clocked_in_now: number;
  total_hours_today: number;
  total_payroll_month: number;
  employees_worked_today: number;
  average_hours_per_employee: number;
}

const AdminDashboard = () => {
  const [metrics, setMetrics] = useState<DashboardMetrics>({
    total_employees: 0,
    clocked_in_now: 0,
    total_hours_today: 0,
    total_payroll_month: 0,
    employees_worked_today: 0,
    average_hours_per_employee: 0,
  });
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchDashboardMetrics();
  }, []);

  const fetchDashboardMetrics = async () => {
    try {
      setLoading(true);
      // Fetch employees
      const employeesRes = await axios.get('/api/admin/employees');
      const employees = employeesRes.data;

      // Fetch payroll summary
      const payrollRes = await axios.get('/api/admin/payroll/summary');
      const payroll = payrollRes.data;

      // Fetch time logs for today
      const today = new Date().toISOString().split('T')[0];
      const logsRes = await axios.get('/api/admin/payroll/time-logs', {
        params: {
          date_from: today,
          date_to: today,
        },
      });
      const logs = logsRes.data;

      setMetrics({
        total_employees: employees.length,
        clocked_in_now: employees.filter((e: any) => e.clocked_in).length || 0,
        total_hours_today: Math.round(logs.total_hours * 100) / 100,
        total_payroll_month: payroll.total_payroll,
        employees_worked_today: logs.employees_worked,
        average_hours_per_employee: logs.employees_worked > 0 ? Math.round((logs.total_hours / logs.employees_worked) * 100) / 100 : 0,
      });
    } catch (err) {
      console.error('Error fetching metrics:', err);
    } finally {
      setLoading(false);
    }
  };

  const StatCard = ({ title, value, icon, color }: any) => (
    <div className="bg-white rounded-lg shadow p-6">
      <div className="flex items-center justify-between">
        <div>
          <p className="text-gray-600 text-sm mb-2">{title}</p>
          <p className={`text-4xl font-bold ${color}`}>{value}</p>
        </div>
        <div className="text-5xl opacity-20">{icon}</div>
      </div>
    </div>
  );

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Branded Header */}
      <BrandedNav title="Admin Portal - Your Clean Team" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {loading ? (
          <div className="flex justify-center items-center py-12">
            <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
          </div>
        ) : (
          <>
            {/* Overview Section */}
            <div className="mb-8">
              <h2 className="text-2xl font-bold text-blue-900 mb-2">Dashboard Overview</h2>
              <p className="text-gray-600">Real-time metrics for Your Clean Team operations</p>
            </div>

            {/* Key Metrics */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
              <StatCard
                title="Total Employees"
                value={metrics.total_employees}
                icon="👥"
                color="text-blue-600"
              />
              <StatCard
                title="Clocked In Now"
                value={metrics.clocked_in_now}
                icon="⏱️"
                color="text-green-600"
              />
              <StatCard
                title="Hours Worked Today"
                value={metrics.total_hours_today.toFixed(1)}
                icon="⏰"
                color="text-purple-600"
              />
              <StatCard
                title="Payroll This Month"
                value={`$${metrics.total_payroll_month.toFixed(2)}`}
                icon="💰"
                color="text-green-500"
              />
              <StatCard
                title="Employees Worked Today"
                value={metrics.employees_worked_today}
                icon="📊"
                color="text-orange-600"
              />
              <StatCard
                title="Avg Hours per Employee"
                value={metrics.average_hours_per_employee.toFixed(1)}
                icon="📈"
                color="text-indigo-600"
              />
            </div>

            {/* Quick Actions */}
            <div className="bg-white rounded-lg shadow p-6 mb-8">
              <h2 className="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h2>
              <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a
                  href="/admin-portal/employees"
                  className="p-4 border border-gray-200 rounded-lg hover:border-blue-400 hover:bg-blue-50 transition"
                >
                  <div className="text-2xl mb-2">👥</div>
                  <h3 className="font-semibold text-gray-900">Manage Employees</h3>
                  <p className="text-sm text-gray-600 mt-1">View and edit employee info</p>
                </a>
                <a
                  href="/admin-portal/time-logs"
                  className="p-4 border border-gray-200 rounded-lg hover:border-green-400 hover:bg-green-50 transition"
                >
                  <div className="text-2xl mb-2">⏱️</div>
                  <h3 className="font-semibold text-gray-900">Time Logs</h3>
                  <p className="text-sm text-gray-600 mt-1">View all time entries</p>
                </a>
                <a
                  href="/admin-portal/payroll"
                  className="p-4 border border-gray-200 rounded-lg hover:border-purple-400 hover:bg-purple-50 transition"
                >
                  <div className="text-2xl mb-2">💳</div>
                  <h3 className="font-semibold text-gray-900">Payroll</h3>
                  <p className="text-sm text-gray-600 mt-1">Manage payroll reports</p>
                </a>
                <a
                  href="/admin-portal/dashboard"
                  className="p-4 border border-gray-200 rounded-lg hover:border-orange-400 hover:bg-orange-50 transition"
                >
                  <div className="text-2xl mb-2">📊</div>
                  <h3 className="font-semibold text-gray-900">Refresh Data</h3>
                  <p className="text-sm text-gray-600 mt-1 cursor-pointer" onClick={fetchDashboardMetrics}>
                    Reload metrics
                  </p>
                </a>
              </div>
            </div>

            {/* Recent Activity Summary */}
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
              {/* Business Stats */}
              <div className="bg-white rounded-lg shadow p-6">
                <h3 className="text-lg font-semibold text-gray-900 mb-4">This Month's Summary</h3>
                <div className="space-y-4">
                  <div className="flex justify-between items-center py-3 border-b">
                    <span className="text-gray-600">Total Payroll</span>
                    <span className="font-semibold text-lg text-green-600">
                      ${metrics.total_payroll_month.toFixed(2)}
                    </span>
                  </div>
                  <div className="flex justify-between items-center py-3 border-b">
                    <span className="text-gray-600">Active Employees</span>
                    <span className="font-semibold text-lg">{metrics.total_employees}</span>
                  </div>
                  <div className="flex justify-between items-center py-3">
                    <span className="text-gray-600">Avg Daily Hours</span>
                    <span className="font-semibold text-lg">{metrics.average_hours_per_employee.toFixed(1)}h</span>
                  </div>
                </div>
              </div>

              {/* System Status */}
              <div className="bg-white rounded-lg shadow p-6">
                <h3 className="text-lg font-semibold text-gray-900 mb-4">System Status</h3>
                <div className="space-y-4">
                  <div className="flex items-center">
                    <div className="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                    <span className="text-gray-700">API Endpoints Active</span>
                  </div>
                  <div className="flex items-center">
                    <div className="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                    <span className="text-gray-700">Employee Portal Running</span>
                  </div>
                  <div className="flex items-center">
                    <div className="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                    <span className="text-gray-700">Database Connected</span>
                  </div>
                  <div className="flex items-center">
                    <div className="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                    <span className="text-gray-700">Last Updated: {new Date().toLocaleTimeString()}</span>
                  </div>
                </div>
              </div>
            </div>
          </>
        )}
      </div>
    </div>
  );
};

export default AdminDashboard;
