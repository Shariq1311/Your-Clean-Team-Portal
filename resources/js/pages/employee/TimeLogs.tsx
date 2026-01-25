import React, { useState, useEffect } from 'react';
import axios from 'axios';

interface TimeLog {
  id: number;
  clock_in: string;
  clock_out: string;
  hours_worked: number;
  status: string;
  notes: string;
}

const TimeLogs = () => {
  const [timeLogs, setTimeLogs] = useState<TimeLog[]>([]);
  const [loading, setLoading] = useState(true);
  const [currentPage, setCurrentPage] = useState(1);
  const [dateFrom, setDateFrom] = useState(new Date(new Date().setDate(new Date().getDate() - 30)).toISOString().split('T')[0]);
  const [dateTo, setDateTo] = useState(new Date().toISOString().split('T')[0]);

  useEffect(() => {
    fetchTimeLogs();
  }, [dateFrom, dateTo, currentPage]);

  const fetchTimeLogs = async () => {
    try {
      setLoading(true);
      const response = await axios.get('/api/time-logs/list', {
        params: {
          date_from: dateFrom,
          date_to: dateTo,
          page: currentPage,
          per_page: 20,
        },
      });
      setTimeLogs(response.data.data || []);
    } catch (err) {
      console.error('Error fetching time logs:', err);
    } finally {
      setLoading(false);
    }
  };

  const formatTime = (dateString: string) => {
    return new Date(dateString).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
  };

  const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleDateString();
  };

  const totalHours = timeLogs.reduce((sum, log) => sum + (log.hours_worked || 0), 0);

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <div className="bg-white shadow">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
          <h1 className="text-3xl font-bold text-gray-900">Time Logs</h1>
          <p className="text-gray-600 mt-1">View your clock in and out records</p>
        </div>
      </div>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {/* Filter Section */}
        <div className="bg-white rounded-lg shadow p-6 mb-6">
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label htmlFor="dateFrom" className="block text-sm font-medium text-gray-700 mb-2">From Date</label>
              <input
                id="dateFrom"
                type="date"
                value={dateFrom}
                onChange={(e) => {
                  setDateFrom(e.target.value);
                  setCurrentPage(1);
                }}
                className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              />
            </div>
            <div>
              <label htmlFor="dateTo" className="block text-sm font-medium text-gray-700 mb-2">To Date</label>
              <input
                id="dateTo"
                type="date"
                value={dateTo}
                onChange={(e) => {
                  setDateTo(e.target.value);
                  setCurrentPage(1);
                }}
                className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              />
            </div>
            <div className="flex items-end">
              <button
                onClick={() => fetchTimeLogs()}
                className="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition"
              >
                Apply Filter
              </button>
            </div>
          </div>
        </div>

        {/* Summary Stats */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
          <div className="bg-white rounded-lg shadow p-6">
            <p className="text-gray-600 text-sm mb-2">Total Hours</p>
            <p className="text-3xl font-bold text-blue-600">{totalHours.toFixed(2)}h</p>
          </div>
          <div className="bg-white rounded-lg shadow p-6">
            <p className="text-gray-600 text-sm mb-2">Total Days</p>
            <p className="text-3xl font-bold text-blue-600">{timeLogs.length}</p>
          </div>
          <div className="bg-white rounded-lg shadow p-6">
            <p className="text-gray-600 text-sm mb-2">Average Hours/Day</p>
            <p className="text-3xl font-bold text-blue-600">
              {timeLogs.length > 0 ? (totalHours / timeLogs.length).toFixed(2) : 0}h
            </p>
          </div>
        </div>

        {/* Time Logs Table */}
        <div className="bg-white rounded-lg shadow overflow-hidden">
          {loading ? (
            <div className="flex justify-center items-center py-12">
              <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            </div>
          ) : timeLogs.length === 0 ? (
            <div className="py-12 text-center">
              <p className="text-gray-500">No time logs found for the selected period</p>
            </div>
          ) : (
            <div className="overflow-x-auto">
              <table className="w-full">
                <thead className="bg-gray-50 border-b border-gray-200">
                  <tr>
                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Clock In</th>
                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Clock Out</th>
                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hours</th>
                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-gray-200">
                  {timeLogs.map((log) => (
                    <tr key={log.id} className="hover:bg-gray-50 transition">
                      <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {formatDate(log.clock_in)}
                      </td>
                      <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        {formatTime(log.clock_in)}
                      </td>
                      <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        {log.clock_out ? formatTime(log.clock_out) : 'N/A'}
                      </td>
                      <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {log.hours_worked?.toFixed(2)}h
                      </td>
                      <td className="px-6 py-4 whitespace-nowrap text-sm">
                        <span className={`inline-flex px-3 py-1 rounded-full text-xs font-semibold ${
                          log.status === 'completed'
                            ? 'bg-green-100 text-green-800'
                            : 'bg-yellow-100 text-yellow-800'
                        }`}>
                          {log.status}
                        </span>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default TimeLogs;
