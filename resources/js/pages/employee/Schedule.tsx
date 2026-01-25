import React, { useState, useEffect } from 'react';
import axios from 'axios';

interface Location {
  id: number;
  name: string;
  address: string;
  city: string;
  state: string;
  zip_code: string;
}

interface Service {
  id: number;
  name: string;
}

interface JobAssignment {
  id: number;
  status: string;
}

interface Schedule {
  id: number;
  service_id: number;
  location_id: number;
  scheduled_date: string;
  start_time: string;
  end_time: string;
  status: string;
  notes?: string;
  location?: Location;
  service?: Service;
  jobs?: JobAssignment[];
}

const Schedule = () => {
  const [schedules, setSchedules] = useState<Schedule[]>([]);
  const [todaySchedules, setTodaySchedules] = useState<Schedule[]>([]);
  const [loading, setLoading] = useState(true);
  const [view, setView] = useState<'calendar' | 'list' | 'today'>('today');
  const [selectedDate, setSelectedDate] = useState(new Date().toISOString().split('T')[0]);

  useEffect(() => {
    fetchSchedules();
    fetchTodaySchedules();
  }, []);

  const fetchSchedules = async () => {
    try {
      setLoading(true);
      const response = await axios.get('/api/schedules');
      setSchedules(response.data);
    } catch (err) {
      console.error('Error fetching schedules:', err);
    } finally {
      setLoading(false);
    }
  };

  const fetchTodaySchedules = async () => {
    try {
      const response = await axios.get('/api/schedules/today');
      setTodaySchedules(response.data);
    } catch (err) {
      console.error('Error fetching today schedules:', err);
    }
  };

  const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleDateString('en-US', {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric',
    });
  };

  const formatTime = (timeString: string) => {
    return new Date(`2000-01-01T${timeString}`).toLocaleTimeString('en-US', {
      hour: '2-digit',
      minute: '2-digit',
    });
  };

  const getStatusBadgeColor = (status: string) => {
    switch (status?.toLowerCase()) {
      case 'completed':
        return 'bg-green-100 text-green-800';
      case 'in-progress':
        return 'bg-blue-100 text-blue-800';
      case 'pending':
        return 'bg-yellow-100 text-yellow-800';
      case 'cancelled':
        return 'bg-red-100 text-red-800';
      default:
        return 'bg-gray-100 text-gray-800';
    }
  };

  const getUpcomingSchedules = () => {
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    return schedules
      .filter((schedule) => new Date(schedule.scheduled_date) >= today)
      .sort((a, b) => new Date(a.scheduled_date).getTime() - new Date(b.scheduled_date).getTime())
      .slice(0, 10);
  };

  const getPastSchedules = () => {
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    return schedules
      .filter((schedule) => new Date(schedule.scheduled_date) < today)
      .sort((a, b) => new Date(b.scheduled_date).getTime() - new Date(a.scheduled_date).getTime())
      .slice(0, 10);
  };

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <div className="bg-white shadow">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
          <h1 className="text-3xl font-bold text-gray-900">Schedule</h1>
          <p className="text-gray-600 mt-1">View your assigned jobs and schedule</p>
        </div>
      </div>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {/* View Selector */}
        <div className="bg-white rounded-lg shadow p-4 mb-6 flex gap-2">
          <button
            onClick={() => setView('today')}
            className={`px-4 py-2 rounded-lg font-medium transition ${
              view === 'today'
                ? 'bg-blue-600 text-white'
                : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
            }`}
          >
            Today
          </button>
          <button
            onClick={() => setView('list')}
            className={`px-4 py-2 rounded-lg font-medium transition ${
              view === 'list'
                ? 'bg-blue-600 text-white'
                : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
            }`}
          >
            Upcoming
          </button>
          <button
            onClick={() => setView('calendar')}
            className={`px-4 py-2 rounded-lg font-medium transition ${
              view === 'calendar'
                ? 'bg-blue-600 text-white'
                : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
            }`}
          >
            All Schedule
          </button>
        </div>

        {loading ? (
          <div className="flex justify-center items-center py-12">
            <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
          </div>
        ) : (
          <>
            {/* Today's Schedule */}
            {view === 'today' && (
              <div className="space-y-6">
                <div className="bg-white rounded-lg shadow overflow-hidden">
                  <div className="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                    <h2 className="text-xl font-bold text-white">Today's Schedule</h2>
                    <p className="text-blue-100">{formatDate(new Date().toISOString().split('T')[0])}</p>
                  </div>
                  {todaySchedules.length > 0 ? (
                    <div className="divide-y">
                      {todaySchedules.map((schedule) => (
                        <div key={schedule.id} className="p-6 hover:bg-gray-50 transition">
                          <div className="flex justify-between items-start mb-3">
                            <div>
                              <h3 className="text-lg font-semibold text-gray-900">
                                {schedule.service?.name || 'Service'}
                              </h3>
                              <p className="text-gray-600">
                                {schedule.location?.name || 'Location'}
                              </p>
                            </div>
                            <span className={`px-3 py-1 rounded-full text-sm font-medium ${getStatusBadgeColor(schedule.status)}`}>
                              {schedule.status || 'Pending'}
                            </span>
                          </div>
                          <div className="grid grid-cols-2 gap-4 mb-3">
                            <div>
                              <p className="text-sm text-gray-500">Time</p>
                              <p className="font-semibold text-gray-900">
                                {formatTime(schedule.start_time)} - {formatTime(schedule.end_time)}
                              </p>
                            </div>
                            <div>
                              <p className="text-sm text-gray-500">Address</p>
                              <p className="font-semibold text-gray-900">
                                {schedule.location?.address}
                              </p>
                            </div>
                          </div>
                          {schedule.notes && (
                            <div className="bg-blue-50 p-3 rounded text-sm text-gray-700 border-l-4 border-blue-400">
                              <strong>Notes:</strong> {schedule.notes}
                            </div>
                          )}
                        </div>
                      ))}
                    </div>
                  ) : (
                    <div className="p-12 text-center">
                      <p className="text-gray-500 text-lg">No schedule for today</p>
                    </div>
                  )}
                </div>
              </div>
            )}

            {/* Upcoming Schedules */}
            {view === 'list' && (
              <div className="space-y-4">
                <div className="bg-white rounded-lg shadow overflow-hidden">
                  <div className="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                    <h2 className="text-xl font-bold text-white">Upcoming Jobs</h2>
                  </div>
                  {getUpcomingSchedules().length > 0 ? (
                    <div className="divide-y">
                      {getUpcomingSchedules().map((schedule) => (
                        <div key={schedule.id} className="p-6 hover:bg-gray-50 transition">
                          <div className="flex justify-between items-start mb-2">
                            <div>
                              <h3 className="text-lg font-semibold text-gray-900">
                                {schedule.service?.name}
                              </h3>
                              <p className="text-gray-600">{formatDate(schedule.scheduled_date)}</p>
                            </div>
                            <span className={`px-3 py-1 rounded-full text-sm font-medium ${getStatusBadgeColor(schedule.status)}`}>
                              {schedule.status}
                            </span>
                          </div>
                          <div className="grid grid-cols-3 gap-4 text-sm">
                            <div>
                              <p className="text-gray-500">Time</p>
                              <p className="font-semibold text-gray-900">
                                {formatTime(schedule.start_time)}
                              </p>
                            </div>
                            <div>
                              <p className="text-gray-500">Location</p>
                              <p className="font-semibold text-gray-900">
                                {schedule.location?.city}, {schedule.location?.state}
                              </p>
                            </div>
                            <div>
                              <p className="text-gray-500">Jobs</p>
                              <p className="font-semibold text-gray-900">
                                {schedule.jobs?.length || 0} assigned
                              </p>
                            </div>
                          </div>
                        </div>
                      ))}
                    </div>
                  ) : (
                    <div className="p-12 text-center">
                      <p className="text-gray-500 text-lg">No upcoming jobs</p>
                    </div>
                  )}
                </div>

                {/* Past Schedules */}
                {getPastSchedules().length > 0 && (
                  <div className="bg-white rounded-lg shadow overflow-hidden">
                    <div className="bg-gradient-to-r from-gray-600 to-gray-700 px-6 py-4">
                      <h2 className="text-xl font-bold text-white">Recent Completed Jobs</h2>
                    </div>
                    <div className="divide-y">
                      {getPastSchedules().map((schedule) => (
                        <div key={schedule.id} className="p-6 hover:bg-gray-50 transition opacity-75">
                          <div className="flex justify-between items-start mb-2">
                            <div>
                              <h3 className="text-lg font-semibold text-gray-900">
                                {schedule.service?.name}
                              </h3>
                              <p className="text-gray-600">{formatDate(schedule.scheduled_date)}</p>
                            </div>
                            <span className={`px-3 py-1 rounded-full text-sm font-medium ${getStatusBadgeColor(schedule.status)}`}>
                              {schedule.status}
                            </span>
                          </div>
                        </div>
                      ))}
                    </div>
                  </div>
                )}
              </div>
            )}

            {/* Calendar/All View */}
            {view === 'calendar' && (
              <div className="bg-white rounded-lg shadow overflow-hidden">
                <div className="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-4">
                  <h2 className="text-xl font-bold text-white">All Scheduled Jobs</h2>
                </div>
                {schedules.length > 0 ? (
                  <div className="overflow-x-auto">
                    <table className="w-full">
                      <thead className="bg-gray-50 border-b">
                        <tr>
                          <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Date</th>
                          <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Service</th>
                          <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Location</th>
                          <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Time</th>
                          <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Status</th>
                        </tr>
                      </thead>
                      <tbody className="divide-y">
                        {schedules.map((schedule) => (
                          <tr key={schedule.id} className="hover:bg-gray-50 transition">
                            <td className="px-6 py-4 text-sm text-gray-900">
                              {formatDate(schedule.scheduled_date)}
                            </td>
                            <td className="px-6 py-4 text-sm text-gray-900">
                              {schedule.service?.name}
                            </td>
                            <td className="px-6 py-4 text-sm text-gray-900">
                              {schedule.location?.city}, {schedule.location?.state}
                            </td>
                            <td className="px-6 py-4 text-sm text-gray-900">
                              {formatTime(schedule.start_time)} - {formatTime(schedule.end_time)}
                            </td>
                            <td className="px-6 py-4 text-sm">
                              <span className={`px-3 py-1 rounded-full text-xs font-medium ${getStatusBadgeColor(schedule.status)}`}>
                                {schedule.status}
                              </span>
                            </td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                ) : (
                  <div className="p-12 text-center">
                    <p className="text-gray-500 text-lg">No scheduled jobs</p>
                  </div>
                )}
              </div>
            )}
          </>
        )}
      </div>
    </div>
  );
};

export default Schedule;
