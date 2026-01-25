import React, { useState, useEffect } from 'react';
import axios from 'axios';

interface Statistics {
  date_from: string;
  date_to: string;
  total_hours: number;
  total_days: number;
  average_hours_per_day: number;
  estimated_earnings: number;
}

const Statistics = () => {
  const [stats, setStats] = useState<Statistics | null>(null);
  const [loading, setLoading] = useState(true);
  const [period, setPeriod] = useState('current_month');

  useEffect(() => {
    fetchStatistics();
  }, [period]);

  const getPeriodDates = () => {
    const today = new Date();
    let dateFrom, dateTo;

    switch (period) {
      case 'current_week':
        const firstDay = new Date(today.setDate(today.getDate() - today.getDay()));
        dateFrom = firstDay.toISOString().split('T')[0];
        dateTo = new Date().toISOString().split('T')[0];
        break;
      case 'current_month':
        dateFrom = new Date(today.getFullYear(), today.getMonth(), 1).toISOString().split('T')[0];
        dateTo = new Date(today.getFullYear(), today.getMonth() + 1, 0).toISOString().split('T')[0];
        break;
      case 'last_month':
        dateFrom = new Date(today.getFullYear(), today.getMonth() - 1, 1).toISOString().split('T')[0];
        dateTo = new Date(today.getFullYear(), today.getMonth(), 0).toISOString().split('T')[0];
        break;
      case 'last_quarter':
        const threeMonthsAgo = new Date(today.setMonth(today.getMonth() - 3));
        dateFrom = threeMonthsAgo.toISOString().split('T')[0];
        dateTo = new Date().toISOString().split('T')[0];
        break;
      default:
        dateFrom = new Date(today.getFullYear(), today.getMonth(), 1).toISOString().split('T')[0];
        dateTo = new Date().toISOString().split('T')[0];
    }

    return { dateFrom, dateTo };
  };

  const fetchStatistics = async () => {
    try {
      setLoading(true);
      const { dateFrom, dateTo } = getPeriodDates();
      const response = await axios.get('/api/time-logs/statistics', {
        params: {
          date_from: dateFrom,
          date_to: dateTo,
        },
      });
      setStats(response.data);
    } catch (err) {
      console.error('Error fetching statistics:', err);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <div className="bg-white shadow">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
          <h1 className="text-3xl font-bold text-gray-900">Statistics</h1>
          <p className="text-gray-600 mt-1">View your work statistics and earnings</p>
        </div>
      </div>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {/* Period Selector */}
        <div className="bg-white rounded-lg shadow p-6 mb-6">
          <h2 className="text-lg font-semibold text-gray-900 mb-4">Select Period</h2>
          <div className="grid grid-cols-2 md:grid-cols-5 gap-2">
            {[
              { value: 'current_week', label: 'This Week' },
              { value: 'current_month', label: 'This Month' },
              { value: 'last_month', label: 'Last Month' },
              { value: 'last_quarter', label: 'Last 3 Months' },
            ].map((option) => (
              <button
                key={option.value}
                onClick={() => setPeriod(option.value)}
                className={`py-2 px-4 rounded-lg font-medium transition ${
                  period === option.value
                    ? 'bg-blue-600 text-white'
                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                }`}
              >
                {option.label}
              </button>
            ))}
          </div>
        </div>

        {/* Statistics Cards */}
        {loading ? (
          <div className="flex justify-center items-center py-12">
            <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
          </div>
        ) : stats ? (
          <>
            {/* Main Stats Grid */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
              {/* Total Hours */}
              <div className="bg-white rounded-lg shadow p-8">
                <div className="flex items-center justify-between">
                  <div>
                    <p className="text-gray-600 text-sm mb-2">Total Hours</p>
                    <p className="text-4xl font-bold text-blue-600">{stats.total_hours.toFixed(1)}</p>
                    <p className="text-gray-500 text-sm mt-2">hours worked</p>
                  </div>
                  <div className="text-5xl text-blue-200">⏱️</div>
                </div>
              </div>

              {/* Total Days */}
              <div className="bg-white rounded-lg shadow p-8">
                <div className="flex items-center justify-between">
                  <div>
                    <p className="text-gray-600 text-sm mb-2">Working Days</p>
                    <p className="text-4xl font-bold text-green-600">{stats.total_days}</p>
                    <p className="text-gray-500 text-sm mt-2">days logged</p>
                  </div>
                  <div className="text-5xl text-green-200">📅</div>
                </div>
              </div>

              {/* Average Hours */}
              <div className="bg-white rounded-lg shadow p-8">
                <div className="flex items-center justify-between">
                  <div>
                    <p className="text-gray-600 text-sm mb-2">Daily Average</p>
                    <p className="text-4xl font-bold text-purple-600">{stats.average_hours_per_day.toFixed(1)}</p>
                    <p className="text-gray-500 text-sm mt-2">hours per day</p>
                  </div>
                  <div className="text-5xl text-purple-200">📊</div>
                </div>
              </div>

              {/* Estimated Earnings */}
              <div className="bg-white rounded-lg shadow p-8">
                <div className="flex items-center justify-between">
                  <div>
                    <p className="text-gray-600 text-sm mb-2">Est. Earnings</p>
                    <p className="text-4xl font-bold text-green-500">${stats.estimated_earnings.toFixed(2)}</p>
                    <p className="text-gray-500 text-sm mt-2">total estimated</p>
                  </div>
                  <div className="text-5xl text-green-200">💰</div>
                </div>
              </div>
            </div>

            {/* Period Info */}
            <div className="bg-blue-50 border border-blue-200 rounded-lg p-6">
              <p className="text-sm text-gray-600">
                <span className="font-semibold">Period:</span> {new Date(stats.date_from).toLocaleDateString()} to {new Date(stats.date_to).toLocaleDateString()}
              </p>
            </div>

            {/* Breakdown */}
            <div className="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
              {/* Quick Facts */}
              <div className="bg-white rounded-lg shadow p-6">
                <h3 className="text-lg font-semibold text-gray-900 mb-4">Summary</h3>
                <div className="space-y-3">
                  <div className="flex justify-between items-center py-2 border-b">
                    <span className="text-gray-600">Total Hours</span>
                    <span className="font-semibold text-gray-900">{stats.total_hours.toFixed(2)}h</span>
                  </div>
                  <div className="flex justify-between items-center py-2 border-b">
                    <span className="text-gray-600">Working Days</span>
                    <span className="font-semibold text-gray-900">{stats.total_days}</span>
                  </div>
                  <div className="flex justify-between items-center py-2 border-b">
                    <span className="text-gray-600">Daily Average</span>
                    <span className="font-semibold text-gray-900">{stats.average_hours_per_day.toFixed(2)}h</span>
                  </div>
                  <div className="flex justify-between items-center py-2">
                    <span className="text-gray-600 font-semibold">Estimated Earnings</span>
                    <span className="font-bold text-green-600 text-lg">${stats.estimated_earnings.toFixed(2)}</span>
                  </div>
                </div>
              </div>

              {/* Info Card */}
              <div className="bg-white rounded-lg shadow p-6">
                <h3 className="text-lg font-semibold text-gray-900 mb-4">About These Stats</h3>
                <div className="space-y-3 text-sm text-gray-600">
                  <p>📊 Statistics are calculated based on your completed clock in/out records.</p>
                  <p>💰 Estimated earnings are calculated using your hourly rate multiplied by total hours.</p>
                  <p>📅 Only days with at least one clock-in record are counted as working days.</p>
                  <p>⏱️ Daily average is calculated by dividing total hours by working days.</p>
                </div>
              </div>
            </div>
          </>
        ) : (
          <div className="bg-white rounded-lg shadow p-12 text-center">
            <p className="text-gray-500">Unable to load statistics</p>
          </div>
        )}
      </div>
    </div>
  );
};

export default Statistics;
