import React, { useState, useEffect } from 'react';
import axios from 'axios';
import BrandedNav from '@/components/BrandedNav';

interface ClockStatus {
  clocked_in: boolean;
  clock_in_time?: string;
  hours_elapsed?: number;
  minutes_elapsed?: number;
}

interface Schedule {
  id: number;
  scheduled_date: string;
  start_time: string;
  end_time: string;
  location: {
    name: string;
    address: string;
    city: string;
    contact_phone: string;
  };
  service: {
    name: string;
    type: string;
  };
}

const EmployeeDashboard = () => {
  const [clockStatus, setClockStatus] = useState<ClockStatus>({ clocked_in: false });
  const [todaySchedule, setTodaySchedule] = useState<Schedule[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);
  const [clockingIn, setClocingIn] = useState(false);

  useEffect(() => {
    fetchClockStatus();
    fetchTodaySchedule();
    const interval = setInterval(fetchClockStatus, 30000); // Refresh every 30 seconds
    return () => clearInterval(interval);
  }, []);

  const fetchClockStatus = async () => {
    try {
      const response = await axios.get('/api/time-logs/current-status');
      setClockStatus(response.data);
    } catch (err) {
      console.error('Error fetching clock status:', err);
    }
  };

  const fetchTodaySchedule = async () => {
    try {
      setLoading(true);
      const response = await axios.get('/api/schedules/today');
      setTodaySchedule(response.data.data || []);
      setError(null);
    } catch (err) {
      setError('Failed to load today\'s schedule');
      console.error('Error fetching schedule:', err);
    } finally {
      setLoading(false);
    }
  };

  const handleClockIn = async () => {
    try {
      setClocingIn(true);
      await axios.post('/api/time-logs/clock-in', {
        notes: 'Portal clock in',
      });
      await fetchClockStatus();
      setClocingIn(false);
    } catch (err: any) {
      setError(err.response?.data?.message || 'Failed to clock in');
      setClocingIn(false);
    }
  };

  const handleClockOut = async () => {
    try {
      setClocingIn(true);
      await axios.post('/api/time-logs/clock-out', {
        notes: 'Portal clock out',
      });
      await fetchClockStatus();
      setClocingIn(false);
    } catch (err: any) {
      setError(err.response?.data?.message || 'Failed to clock out');
      setClocingIn(false);
    }
  };

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Branded Header */}
      <BrandedNav title="Employee Portal - Your Clean Team" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {/* Section Header */}
        <div className="mb-8">
          <h2 className="text-2xl font-bold text-blue-900 mb-2">Welcome to Your Clean Team</h2>
          <p className="text-gray-600">Manage your time, schedule, and work information</p>
        </div>

        {error && (
          <div className="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
            <p className="text-red-700">{error}</p>
          </div>
        )}

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          {/* Clock In/Out Card */}
          <div className="bg-white rounded-lg shadow-lg p-8">
            <h2 className="text-2xl font-bold text-gray-900 mb-6">Time Tracking</h2>

            {/* Clock Status Display */}
            <div className="mb-8">
              <div className={`inline-flex items-center px-4 py-2 rounded-full ${
                clockStatus.clocked_in
                  ? 'bg-green-100 text-green-800'
                  : 'bg-gray-100 text-gray-800'
              }`}>
                <span className={`inline-block w-3 h-3 rounded-full mr-2 ${
                  clockStatus.clocked_in ? 'bg-green-500' : 'bg-gray-500'
                }`}></span>
                {clockStatus.clocked_in ? 'Clocked In' : 'Clocked Out'}
              </div>
            </div>

            {/* Time Display */}
            {clockStatus.clocked_in && (
              <div className="mb-8 p-4 bg-blue-50 rounded-lg">
                <p className="text-gray-600 text-sm mb-2">Time Worked</p>
                <p className="text-3xl font-bold text-blue-600">
                  {clockStatus.hours_elapsed}h {clockStatus.minutes_elapsed}m
                </p>
                <p className="text-gray-600 text-sm mt-2">
                  Clocked in at: {clockStatus.clock_in_time && new Date(clockStatus.clock_in_time).toLocaleTimeString()}
                </p>
              </div>
            )}

            {/* Clock In/Out Buttons */}
            <div className="space-y-3">
              {clockStatus.clocked_in ? (
                <button
                  onClick={handleClockOut}
                  disabled={clockingIn}
                  className="w-full bg-red-600 hover:bg-red-700 disabled:bg-red-400 text-white font-bold py-4 px-6 rounded-lg transition duration-200 text-lg"
                >
                  {clockingIn ? 'Processing...' : 'Clock Out'}
                </button>
              ) : (
                <button
                  onClick={handleClockIn}
                  disabled={clockingIn}
                  className="w-full bg-green-600 hover:bg-green-700 disabled:bg-green-400 text-white font-bold py-4 px-6 rounded-lg transition duration-200 text-lg"
                >
                  {clockingIn ? 'Processing...' : 'Clock In'}
                </button>
              )}
            </div>

            {/* Quick Links */}
            <div className="mt-8 pt-8 border-t">
              <p className="text-gray-600 text-sm mb-4">Quick Actions</p>
              <div className="space-y-2">
                <a href="/employee/time-logs" className="block text-blue-600 hover:text-blue-800 text-sm">
                  View Time History →
                </a>
                <a href="/employee/statistics" className="block text-blue-600 hover:text-blue-800 text-sm">
                  View Statistics →
                </a>
              </div>
            </div>
          </div>

          {/* Today's Schedule Card */}
          <div className="bg-white rounded-lg shadow-lg p-8">
            <h2 className="text-2xl font-bold text-gray-900 mb-6">Today's Schedule</h2>

            {loading ? (
              <div className="flex justify-center items-center py-8">
                <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
              </div>
            ) : todaySchedule.length === 0 ? (
              <div className="py-8 text-center">
                <p className="text-gray-500">No scheduled jobs for today</p>
              </div>
            ) : (
              <div className="space-y-4 max-h-96 overflow-y-auto">
                {todaySchedule.map((schedule) => (
                  <div key={schedule.id} className="p-4 border border-gray-200 rounded-lg hover:border-blue-300 transition">
                    <div className="flex justify-between items-start mb-2">
                      <h3 className="font-semibold text-gray-900">{schedule.service.name}</h3>
                      <span className="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded">
                        {schedule.start_time} - {schedule.end_time}
                      </span>
                    </div>

                    <div className="text-sm text-gray-600 space-y-1">
                      <p>📍 {schedule.location.name}</p>
                      <p>{schedule.location.address}, {schedule.location.city}</p>
                      {schedule.location.contact_phone && (
                        <p>📞 {schedule.location.contact_phone}</p>
                      )}
                    </div>

                    <button className="mt-3 w-full text-sm text-blue-600 hover:text-blue-800 font-medium">
                      View Details →
                    </button>
                  </div>
                ))}
              </div>
            )}

            <div className="mt-8 pt-8 border-t">
              <a href="/employee/schedule" className="text-blue-600 hover:text-blue-800 text-sm font-medium">
                View Full Schedule →
              </a>
            </div>
          </div>
        </div>

        {/* Stats Section */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
          <div className="bg-white rounded-lg shadow p-6">
            <p className="text-gray-600 text-sm mb-2">Status</p>
            <p className="text-2xl font-bold text-gray-900">
              {clockStatus.clocked_in ? 'Active' : 'Inactive'}
            </p>
          </div>
          <div className="bg-white rounded-lg shadow p-6">
            <p className="text-gray-600 text-sm mb-2">Today's Jobs</p>
            <p className="text-2xl font-bold text-gray-900">{todaySchedule.length}</p>
          </div>
          <div className="bg-white rounded-lg shadow p-6">
            <p className="text-gray-600 text-sm mb-2">Time Worked</p>
            <p className="text-2xl font-bold text-gray-900">
              {clockStatus.hours_elapsed ? `${clockStatus.hours_elapsed}h` : '0h'}
            </p>
          </div>
        </div>
      </div>
    </div>
  );
};

export default EmployeeDashboard;
