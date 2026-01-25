import React, { useState, useEffect } from 'react';
import axios from 'axios';
import BrandedNav from '@/components/BrandedNav';

interface TimeLog {
  id: number;
  user_id: number;
  user: {
    name: string;
    position: string;
  };
  clock_in_time: string;
  clock_out_time: string;
  hours_worked: number;
}

interface TimeTrackingData {
  time_logs: {
    data: TimeLog[];
  };
  total_hours: number;
  employees_worked: number;
}

const TimeTrackingOverview = () => {
  const [data, setData] = useState<TimeTrackingData | null>(null);
  const [loading, setLoading] = useState(true);
  const [dateFrom, setDateFrom] = useState(new Date().toISOString().split('T')[0]);
  const [dateTo, setDateTo] = useState(new Date().toISOString().split('T')[0]);
  const [selectedEmployee, setSelectedEmployee] = useState<string>('');

  useEffect(() => {
    fetchTimeTrackingData();
  }, [dateFrom, dateTo, selectedEmployee]);

  const fetchTimeTrackingData = async () => {
    try {
      setLoading(true);
      const params: any = {
        date_from: dateFrom,
        date_to: dateTo,
      };
      if (selectedEmployee) {
        params.employee_id = selectedEmployee;
      }

      const response = await axios.get('/api/admin/payroll/time-logs', { params });
      setData(response.data);
    } catch (err) {
      console.error('Error fetching time tracking data:', err);
    } finally {
      setLoading(false);
    }
  };

  const formatDateTime = (dateTime: string) => {
    return new Date(dateTime).toLocaleString('en-US', {
      month: 'short',
      day: 'numeric',
      year: 'numeric',
      hour: '2-digit',
      minute: '2-digit',
    });
  };

  const getStatusColor = (date: string) => {
    const logDate = new Date(date).toDateString();
    const today = new Date().toDateString();
    return logDate === today ? 'bg-green-100' : 'bg-gray-100';
  };

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Branded Header */}
      <BrandedNav title="Time Tracking - Your Clean Team" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {/* Section Header */}
        <div className="mb-8">
          <h2 className="text-2xl font-bold text-blue-900 mb-2">Time Tracking Overview</h2>
          <p className="text-gray-600">Monitor employee hours and daily time logs</p>
        </div>

        {/* Filters */}
        <div className="bg-white rounded-lg shadow p-6 mb-6">
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">From Date</label>
              <input
                type="date"
                value={dateFrom}
                onChange={(e) => setDateFrom(e.target.value)}
                className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                aria-label="Filter from date"
              />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">To Date</label>
              <input
                type="date"
                value={dateTo}
                onChange={(e) => setDateTo(e.target.value)}
                className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                aria-label="Filter to date"
              />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">Employee (Optional)</label>
              <input
                type="text"
                placeholder="Enter employee ID..."
                value={selectedEmployee}
                onChange={(e) => setSelectedEmployee(e.target.value)}
                className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
              />
            </div>
          </div>
        </div>

        {loading ? (
          <div className="flex justify-center items-center py-12">
            <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
          </div>
        ) : data ? (
          <>
            {/* Summary Stats */}
            <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
              <div className="bg-white rounded-lg shadow p-6">
                <p className="text-gray-600 text-sm mb-2">Total Hours Worked</p>
                <p className="text-4xl font-bold text-blue-600">{data.total_hours.toFixed(1)}</p>
                <p className="text-sm text-gray-600 mt-2">Period: {dateFrom} to {dateTo}</p>
              </div>
              <div className="bg-white rounded-lg shadow p-6">
                <p className="text-gray-600 text-sm mb-2">Employees Worked</p>
                <p className="text-4xl font-bold text-green-600">{data.employees_worked}</p>
              </div>
              <div className="bg-white rounded-lg shadow p-6">
                <p className="text-gray-600 text-sm mb-2">Average Hours per Employee</p>
                <p className="text-4xl font-bold text-purple-600">
                  {data.employees_worked > 0 ? (data.total_hours / data.employees_worked).toFixed(1) : '0'}
                </p>
              </div>
            </div>

            {/* Time Logs Table */}
            <div className="bg-white rounded-lg shadow overflow-hidden">
              <div className="overflow-x-auto">
                <table className="w-full">
                  <thead className="bg-gray-50 border-b">
                    <tr>
                      <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Employee</th>
                      <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Clock In</th>
                      <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Clock Out</th>
                      <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Hours Worked</th>
                      <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Status</th>
                    </tr>
                  </thead>
                  <tbody className="divide-y">
                    {data.time_logs.data && data.time_logs.data.length > 0 ? (
                      data.time_logs.data.map(log => (
                        <tr key={log.id} className={`hover:bg-gray-50 transition ${getStatusColor(log.clock_in_time)}`}>
                          <td className="px-6 py-4">
                            <div>
                              <p className="font-semibold text-gray-900">{log.user.name}</p>
                              <p className="text-sm text-gray-600">{log.user.position}</p>
                            </div>
                          </td>
                          <td className="px-6 py-4 text-sm text-gray-700">
                            {formatDateTime(log.clock_in_time)}
                          </td>
                          <td className="px-6 py-4 text-sm text-gray-700">
                            {log.clock_out_time ? formatDateTime(log.clock_out_time) : 'Still clocked in'}
                          </td>
                          <td className="px-6 py-4 text-sm font-semibold text-gray-900">
                            {log.hours_worked.toFixed(2)}h
                          </td>
                          <td className="px-6 py-4 text-sm">
                            {!log.clock_out_time ? (
                              <span className="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                Active
                              </span>
                            ) : (
                              <span className="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-medium">
                                Completed
                              </span>
                            )}
                          </td>
                        </tr>
                      ))
                    ) : (
                      <tr>
                        <td colSpan={5} className="px-6 py-12 text-center">
                          <p className="text-gray-500 text-lg">No time logs found for the selected period</p>
                        </td>
                      </tr>
                    )}
                  </tbody>
                </table>
              </div>
            </div>

            {/* Export Options */}
            <div className="mt-6 bg-white rounded-lg shadow p-6">
              <h3 className="font-semibold text-gray-900 mb-4">Export Options</h3>
              <div className="flex gap-2">
                <button className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                  📊 Export to CSV
                </button>
                <button className="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                  📄 Export to PDF
                </button>
                <button className="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                  📧 Email Report
                </button>
              </div>
            </div>
          </>
        ) : (
          <div className="bg-white rounded-lg shadow p-12 text-center">
            <p className="text-gray-500 text-lg">Unable to load time tracking data</p>
          </div>
        )}
      </div>
    </div>
  );
};

export default TimeTrackingOverview;
