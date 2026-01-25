import React, { useState, useEffect } from 'react';
import axios from 'axios';
import BrandedNav from '@/components/BrandedNav';

interface PayrollEmployee {
  employee_id: number;
  employee_name: string;
  position: string;
  hours_worked: number;
  hourly_rate: number;
  total_earnings: number;
  days_worked: number;
}

interface PayrollSummaryData {
  date_from: string;
  date_to: string;
  payroll_data: PayrollEmployee[];
  total_payroll: number;
  total_employees: number;
  average_pay_per_employee: number;
}

const PayrollSummary = () => {
  const [data, setData] = useState<PayrollSummaryData | null>(null);
  const [loading, setLoading] = useState(true);
  const [dateFrom, setDateFrom] = useState(new Date(new Date().getFullYear(), new Date().getMonth(), 1).toISOString().split('T')[0]);
  const [dateTo, setDateTo] = useState(new Date().toISOString().split('T')[0]);
  const [selectedEmployee, setSelectedEmployee] = useState<number | null>(null);
  const [employeeDetail, setEmployeeDetail] = useState<any>(null);

  useEffect(() => {
    fetchPayrollSummary();
  }, [dateFrom, dateTo]);

  const fetchPayrollSummary = async () => {
    try {
      setLoading(true);
      const response = await axios.get('/api/admin/payroll/summary', {
        params: {
          date_from: dateFrom,
          date_to: dateTo,
        },
      });
      setData(response.data);
    } catch (err) {
      console.error('Error fetching payroll summary:', err);
    } finally {
      setLoading(false);
    }
  };

  const handleEmployeeClick = async (employeeId: number) => {
    try {
      const response = await axios.get(`/api/admin/payroll/employee/${employeeId}`, {
        params: {
          date_from: dateFrom,
          date_to: dateTo,
        },
      });
      setSelectedEmployee(employeeId);
      setEmployeeDetail(response.data);
    } catch (err) {
      console.error('Error fetching employee payroll:', err);
    }
  };

  const formatDate = (date: string) => {
    return new Date(date).toLocaleDateString('en-US', {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
    });
  };

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Branded Header */}
      <BrandedNav title="Payroll Management - Your Clean Team" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {/* Section Header */}
        <div className="mb-8">
          <h2 className="text-2xl font-bold text-blue-900 mb-2">Payroll Summary</h2>
          <p className="text-gray-600">Calculate and review employee compensation</p>
        </div>

        {/* Period Selection */}
        <div className="bg-white rounded-lg shadow p-6 mb-6">
          <h3 className="text-lg font-semibold text-gray-900 mb-4">Select Period</h3>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">From Date</label>
              <input
                type="date"
                value={dateFrom}
                onChange={(e) => setDateFrom(e.target.value)}
                className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                aria-label="Payroll period start date"
              />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">To Date</label>
              <input
                type="date"
                value={dateTo}
                onChange={(e) => setDateTo(e.target.value)}
                className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                aria-label="Payroll period end date"
              />
            </div>
            <div className="flex items-end">
              <button
                onClick={fetchPayrollSummary}
                className="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
              >
                Refresh
              </button>
            </div>
          </div>
        </div>

        {loading ? (
          <div className="flex justify-center items-center py-12">
            <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
          </div>
        ) : data ? (
          <>
            {/* Summary Cards */}
            <div className="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
              <div className="bg-white rounded-lg shadow p-6">
                <p className="text-gray-600 text-sm mb-2">Total Payroll</p>
                <p className="text-4xl font-bold text-green-600">${data.total_payroll.toFixed(2)}</p>
              </div>
              <div className="bg-white rounded-lg shadow p-6">
                <p className="text-gray-600 text-sm mb-2">Employees</p>
                <p className="text-4xl font-bold text-blue-600">{data.total_employees}</p>
              </div>
              <div className="bg-white rounded-lg shadow p-6">
                <p className="text-gray-600 text-sm mb-2">Avg Pay per Employee</p>
                <p className="text-4xl font-bold text-purple-600">${data.average_pay_per_employee.toFixed(2)}</p>
              </div>
              <div className="bg-white rounded-lg shadow p-6">
                <p className="text-gray-600 text-sm mb-2">Period</p>
                <p className="text-sm font-semibold text-gray-900">{formatDate(data.date_from)} to {formatDate(data.date_to)}</p>
              </div>
            </div>

            {/* Payroll Table */}
            <div className="bg-white rounded-lg shadow overflow-hidden mb-6">
              <div className="overflow-x-auto">
                <table className="w-full">
                  <thead className="bg-gray-50 border-b">
                    <tr>
                      <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Employee</th>
                      <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Position</th>
                      <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Days Worked</th>
                      <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Hours Worked</th>
                      <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Hourly Rate</th>
                      <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Total Earnings</th>
                      <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Action</th>
                    </tr>
                  </thead>
                  <tbody className="divide-y">
                    {data.payroll_data.length > 0 ? (
                      data.payroll_data.map(emp => (
                        <tr key={emp.employee_id} className="hover:bg-gray-50 transition">
                          <td className="px-6 py-4 font-semibold text-gray-900">{emp.employee_name}</td>
                          <td className="px-6 py-4 text-sm text-gray-600">{emp.position || 'N/A'}</td>
                          <td className="px-6 py-4 text-sm text-gray-900">{emp.days_worked}</td>
                          <td className="px-6 py-4 text-sm text-gray-900">{emp.hours_worked.toFixed(2)}h</td>
                          <td className="px-6 py-4 text-sm text-gray-900">${emp.hourly_rate.toFixed(2)}/hr</td>
                          <td className="px-6 py-4 text-sm font-bold text-green-600">${emp.total_earnings.toFixed(2)}</td>
                          <td className="px-6 py-4 text-sm">
                            <button
                              onClick={() => handleEmployeeClick(emp.employee_id)}
                              className="px-3 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700 transition"
                            >
                              Details
                            </button>
                          </td>
                        </tr>
                      ))
                    ) : (
                      <tr>
                        <td colSpan={7} className="px-6 py-12 text-center">
                          <p className="text-gray-500 text-lg">No payroll data available for the selected period</p>
                        </td>
                      </tr>
                    )}
                  </tbody>
                  <tfoot className="bg-gray-50 border-t">
                    <tr>
                      <td colSpan={5} className="px-6 py-4 text-sm font-bold text-gray-900">
                        Total Payroll:
                      </td>
                      <td className="px-6 py-4 text-sm font-bold text-green-600">${data.total_payroll.toFixed(2)}</td>
                      <td></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>

            {/* Employee Detail Modal */}
            {employeeDetail && (
              <div className="bg-white rounded-lg shadow p-6 mb-6">
                <div className="flex justify-between items-start mb-6">
                  <div>
                    <h3 className="text-2xl font-bold text-gray-900">{employeeDetail.employee_name}</h3>
                    <p className="text-gray-600">{employeeDetail.position}</p>
                  </div>
                  <button
                    onClick={() => {
                      setSelectedEmployee(null);
                      setEmployeeDetail(null);
                    }}
                    className="text-gray-400 hover:text-gray-600 text-2xl"
                  >
                    ×
                  </button>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                  <div>
                    <p className="text-gray-600 text-sm mb-2">Total Hours</p>
                    <p className="text-3xl font-bold text-blue-600">{employeeDetail.total_hours.toFixed(2)}h</p>
                  </div>
                  <div>
                    <p className="text-gray-600 text-sm mb-2">Hourly Rate</p>
                    <p className="text-3xl font-bold text-gray-900">${employeeDetail.hourly_rate.toFixed(2)}</p>
                  </div>
                  <div>
                    <p className="text-gray-600 text-sm mb-2">Total Earnings</p>
                    <p className="text-3xl font-bold text-green-600">${employeeDetail.total_earnings.toFixed(2)}</p>
                  </div>
                </div>

                {/* Time Logs Detail */}
                <div className="border-t pt-6">
                  <h4 className="font-semibold text-gray-900 mb-4">Time Log Details</h4>
                  <div className="overflow-x-auto">
                    <table className="w-full text-sm">
                      <thead className="bg-gray-50">
                        <tr>
                          <th className="px-4 py-2 text-left font-semibold text-gray-900">Date</th>
                          <th className="px-4 py-2 text-left font-semibold text-gray-900">Clock In</th>
                          <th className="px-4 py-2 text-left font-semibold text-gray-900">Clock Out</th>
                          <th className="px-4 py-2 text-left font-semibold text-gray-900">Hours</th>
                        </tr>
                      </thead>
                      <tbody className="divide-y">
                        {employeeDetail.time_logs?.map((log: any) => (
                          <tr key={log.id} className="hover:bg-gray-50">
                            <td className="px-4 py-2 text-gray-600">{new Date(log.date).toLocaleDateString()}</td>
                            <td className="px-4 py-2 text-gray-600">{new Date(log.clock_in).toLocaleTimeString()}</td>
                            <td className="px-4 py-2 text-gray-600">{log.clock_out ? new Date(log.clock_out).toLocaleTimeString() : 'N/A'}</td>
                            <td className="px-4 py-2 font-semibold text-gray-900">{log.hours.toFixed(2)}h</td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            )}

            {/* Export Options */}
            <div className="bg-white rounded-lg shadow p-6">
              <h3 className="font-semibold text-gray-900 mb-4">Export Payroll</h3>
              <div className="flex gap-2 flex-wrap">
                <button className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                  📊 Export to CSV
                </button>
                <button className="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                  📄 Export to PDF
                </button>
                <button className="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                  📧 Email Payroll Slips
                </button>
                <button className="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                  🎯 Generate Report
                </button>
              </div>
            </div>
          </>
        ) : (
          <div className="bg-white rounded-lg shadow p-12 text-center">
            <p className="text-gray-500 text-lg">Unable to load payroll data</p>
          </div>
        )}
      </div>
    </div>
  );
};

export default PayrollSummary;
