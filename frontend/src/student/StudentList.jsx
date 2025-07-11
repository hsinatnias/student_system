import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';

export default function StudentList() {
  const [students, setStudents] = useState([]);
  const [openDropdownId, setOpenDropdownId] = useState(null)

  const getBadgeClass = (status) => {
    switch (status) {
      case 'approved': return 'bg-green-700';
      case 'pending': return 'bg-gray-700';
      case 'denied': return 'bg-red-700';
      default: return 'bg-dark-700';
    }
  };

  const fetchStudents = async () => {
    const token = localStorage.getItem('token');
    try {
      const res = await axios.get('/api/student', {
        headers: {
          Authorization: `Bearer ${token}`
        }
      });
      setStudents(res.data);
    } catch (err) {
      console.error('Failed to fetch students', err);
    }
  };

  const deleteStudent = async (id) => {
    const token = localStorage.getItem('token');
    try {
      await axios.delete(`/api/student/delete?id=${id}`, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      });
      setStudents(students.filter(s => s.id !== id));
    } catch (err) {
      console.error('Failed to delete student', err);
    }
  };

  const updateStatus = async (id, status) => {
    const token = localStorage.getItem('token');
    try {
      await axios.post(`/api/student/updatestatus?id=${id}`, { status }, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      });
      fetchStudents(); 
       setOpenDropdownId(null);
    } catch (err) {
      console.error('Failed to update status', err);
    }
  };


  useEffect(() => {
    fetchStudents();
  }, []);

  return (
    <div className="max-w-5xl mx-auto mt-10 bg-white p-6 rounded shadow">
      <h2 className="text-2xl font-semibold mb-6 text-center">Student List</h2>
  
      {students.length === 0 && (
        <p className="text-center text-gray-500">No students found</p>
      )}
  
      <ul className="space-y-4">
        {students.map(student => (
          <li
            key={student.id}
            className="flex items-center justify-between bg-gray-100 p-4 rounded shadow-sm"
          >
            <div>
              <p className="font-semibold text-lg">{student.first_name} {student.last_name}</p>
              <p className="text-sm text-gray-600">{student.email}</p>
            </div>
  
            <div className="flex items-center gap-2">
              <div className="flex items-center gap-2 relative">
                <button
                  className={`px-3 py-1 rounded text-sm font-medium border border-gray-300  ${getBadgeClass(student.status)} hover:bg-gray-100 transition`}
                  onClick={()=>
                    setOpenDropdownId(openDropdownId === student.id ? null: student.id)
                  }
                >
                  {student.status}
                </button>
                {openDropdownId === student.id && (
                  <div className="absolute top-full left-0 mt-2 bg-white border border-gray-300 rounded shadow z-10">
                  <button className="block px-4 py-2 hover:bg-gray-100 w-full text-left whitespace-nowrap"
                    onClick={() => updateStatus(student.id, 'approved')}>Approve</button>
                  <button className="block px-4 py-2 hover:bg-gray-100 w-full text-left whitespace-nowrap"
                    onClick={() => updateStatus(student.id, 'pending')}>Set Pending</button>
                  <button className="block px-4 py-2 hover:bg-gray-100 w-full text-left whitespace-nowrap"
                    onClick={() => updateStatus(student.id, 'denied')}>Deny</button>
                </div>
                )}
                
              </div>
  
              <Link to={`/student/${student.id}`} className="px-2 py-1 text-blue-600 hover:underline text-sm">
                View
              </Link>
              <Link to={`/student/edit/${student.id}`} className="px-2 py-1 text-yellow-600 hover:underline text-sm">
                Edit
              </Link>
              <button
                onClick={() => deleteStudent(student.id)}
                className="px-2 py-1 text-red-600 hover:underline text-sm"
              >
                Delete
              </button>
            </div>
          </li>
        ))}
      </ul>
    </div>
  );
  
}
