import React, { useState, useEffect } from 'react';
import axios from 'axios';
import BrandedNav from '@/components/BrandedNav';

interface Employee {
  id: number;
  name: string;
  email: string;
  phone: string;
  position: string;
  hire_date: string;
  hourly_rate: number;
  created_at: string;
}

const EmployeeManagement = () => {
  const [employees, setEmployees] = useState<Employee[]>([]);
  const [loading, setLoading] = useState(true);
  const [searchTerm, setSearchTerm] = useState('');
  const [editingId, setEditingId] = useState<number | null>(null);
  const [editData, setEditData] = useState<Partial<Employee>>({});
  const [selectedEmployees, setSelectedEmployees] = useState<number[]>([]);

  useEffect(() => {
    fetchEmployees();
  }, []);

  const fetchEmployees = async () => {
    try {
      setLoading(true);
      const response = await axios.get('/api/admin/employees');
      setEmployees(response.data);
    } catch (err) {
      console.error('Error fetching employees:', err);
    } finally {
      setLoading(false);
    }
  };

  const handleEdit = (employee: Employee) => {
    setEditingId(employee.id);
    setEditData(employee);
  };

  const handleSave = async () => {
    if (!editingId) return;

    try {
      await axios.put(`/api/admin/employees/${editingId}`, editData);
      setEmployees(employees.map(e => e.id === editingId ? { ...e, ...editData } : e));
      setEditingId(null);
    } catch (err) {
      console.error('Error updating employee:', err);
    }
  };

  const handleDelete = async (id: number) => {
    if (confirm('Are you sure you want to delete this employee?')) {
      try {
        await axios.delete(`/api/admin/employees/${id}`);
        setEmployees(employees.filter(e => e.id !== id));
      } catch (err) {
        console.error('Error deleting employee:', err);
      }
    }
  };

  const handleSelectEmployee = (id: number) => {
    setSelectedEmployees(prev =>
      prev.includes(id) ? prev.filter(e => e !== id) : [...prev, id]
    );
  };

  const handleBulkStatusUpdate = async (status: string) => {
    if (selectedEmployees.length === 0) return;

    try {
      await axios.post('/api/admin/employees/bulk-status', {
        employee_ids: selectedEmployees,
        status,
      });
      fetchEmployees();
      setSelectedEmployees([]);
    } catch (err) {
      console.error('Error updating employee status:', err);
    }
  };

  const filteredEmployees = employees.filter(emp =>
    emp.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
    emp.email.toLowerCase().includes(searchTerm.toLowerCase()) ||
    emp.position?.toLowerCase().includes(searchTerm.toLowerCase())
  );

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Branded Header */}
      <BrandedNav title="Employee Management - Your Clean Team" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {/* Section Header */}
        <div className="mb-8">
          <h2 className="text-2xl font-bold text-blue-900 mb-2">Manage Your Team</h2>
          <p className="text-gray-600">View, edit, and manage all employees in Your Clean Team</p>
        </div>

        {/* Search and Filters */}
        <div className="bg-white rounded-lg shadow p-6 mb-6">
          <div className="flex flex-col md:flex-row gap-4">
            <input
              type="text"
              placeholder="Search by name, email, or position..."
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
            {selectedEmployees.length > 0 && (
              <div className="flex gap-2">
                <button
                  onClick={() => handleBulkStatusUpdate('active')}
                  className="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700"
                >
                  Mark Active ({selectedEmployees.length})
                </button>
                <button
                  onClick={() => handleBulkStatusUpdate('inactive')}
                  className="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
                >
                  Mark Inactive
                </button>
              </div>
            )}
          </div>
        </div>

        {loading ? (
          <div className="flex justify-center items-center py-12">
            <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
          </div>
        ) : filteredEmployees.length > 0 ? (
          <div className="bg-white rounded-lg shadow overflow-hidden">
            <table className="w-full">
              <thead className="bg-gray-50 border-b">
                <tr>
                  <th className="px-6 py-3 text-left">
                    <input
                      type="checkbox"
                      onChange={(e) => {
                        if (e.target.checked) {
                          setSelectedEmployees(filteredEmployees.map(e => e.id));
                        } else {
                          setSelectedEmployees([]);
                        }
                      }}
                      aria-label="Select all employees"
                    />
                  </th>
                  <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Name</th>
                  <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Email</th>
                  <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Position</th>
                  <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Hourly Rate</th>
                  <th className="px-6 py-3 text-left text-sm font-semibold text-gray-900">Actions</th>
                </tr>
              </thead>
              <tbody className="divide-y">
                {filteredEmployees.map(employee => (
                  <tr key={employee.id} className="hover:bg-gray-50 transition">
                    <td className="px-6 py-4">
                      <input
                        type="checkbox"
                        checked={selectedEmployees.includes(employee.id)}
                        onChange={() => handleSelectEmployee(employee.id)}
                        aria-label={`Select ${employee.name}`}
                      />
                    </td>
                    <td className="px-6 py-4">
                      {editingId === employee.id ? (
                        <input
                          type="text"
                          value={editData.name || ''}
                          onChange={(e) => setEditData({ ...editData, name: e.target.value })}
                          className="w-full px-2 py-1 border rounded"
                          aria-label="Edit employee name"
                        />
                      ) : (
                        <div>
                          <p className="font-semibold text-gray-900">{employee.name}</p>
                          <p className="text-sm text-gray-600">{employee.phone}</p>
                        </div>
                      )}
                    </td>
                    <td className="px-6 py-4">
                      {editingId === employee.id ? (
                        <input
                          type="email"
                          value={editData.email || ''}
                          onChange={(e) => setEditData({ ...editData, email: e.target.value })}
                          className="w-full px-2 py-1 border rounded"
                          aria-label="Edit employee email"
                        />
                      ) : (
                        <p className="text-sm text-gray-600">{employee.email}</p>
                      )}
                    </td>
                    <td className="px-6 py-4">
                      {editingId === employee.id ? (
                        <input
                          type="text"
                          value={editData.position || ''}
                          onChange={(e) => setEditData({ ...editData, position: e.target.value })}
                          className="w-full px-2 py-1 border rounded"
                          aria-label="Edit employee position"
                        />
                      ) : (
                        <p className="text-sm text-gray-600">{employee.position || 'N/A'}</p>
                      )}
                    </td>
                    <td className="px-6 py-4">
                      {editingId === employee.id ? (
                        <input
                          type="number"
                          value={editData.hourly_rate || 0}
                          onChange={(e) => setEditData({ ...editData, hourly_rate: parseFloat(e.target.value) })}
                          className="w-full px-2 py-1 border rounded"                          aria-label="Edit employee hourly rate"                        />
                      ) : (
                        <p className="text-sm font-semibold text-gray-900">${employee.hourly_rate?.toFixed(2) || '0.00'}/hr</p>
                      )}
                    </td>
                    <td className="px-6 py-4 text-sm space-x-2">
                      {editingId === employee.id ? (
                        <>
                          <button
                            onClick={handleSave}
                            className="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-xs"
                          >
                            Save
                          </button>
                          <button
                            onClick={() => setEditingId(null)}
                            className="px-3 py-1 bg-gray-400 text-white rounded hover:bg-gray-500 text-xs"
                          >
                            Cancel
                          </button>
                        </>
                      ) : (
                        <>
                          <button
                            onClick={() => handleEdit(employee)}
                            className="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs"
                          >
                            Edit
                          </button>
                          <button
                            onClick={() => handleDelete(employee.id)}
                            className="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs"
                          >
                            Delete
                          </button>
                        </>
                      )}
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        ) : (
          <div className="bg-white rounded-lg shadow p-12 text-center">
            <p className="text-gray-500 text-lg">No employees found</p>
          </div>
        )}

        {/* Summary Card */}
        {filteredEmployees.length > 0 && (
          <div className="mt-6 bg-white rounded-lg shadow p-6">
            <h3 className="font-semibold text-gray-900 mb-4">Team Summary</h3>
            <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
              <div>
                <p className="text-gray-600 text-sm">Total Employees</p>
                <p className="text-3xl font-bold text-gray-900">{filteredEmployees.length}</p>
              </div>
              <div>
                <p className="text-gray-600 text-sm">Average Hourly Rate</p>
                <p className="text-3xl font-bold text-gray-900">
                  ${(filteredEmployees.reduce((sum, e) => sum + (e.hourly_rate || 0), 0) / filteredEmployees.length).toFixed(2)}
                </p>
              </div>
              <div>
                <p className="text-gray-600 text-sm">Total Monthly Capacity</p>
                <p className="text-3xl font-bold text-gray-900">
                  ${(filteredEmployees.reduce((sum, e) => sum + (e.hourly_rate || 0) * 160, 0)).toFixed(2)}
                </p>
              </div>
            </div>
          </div>
        )}
      </div>
    </div>
  );
};

export default EmployeeManagement;
