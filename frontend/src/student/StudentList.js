import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';

export default function StudentList() {
  const [students, setStudents] = useState([]);
  const getBadgeClass = (status) => {
    switch (status) {
      case 'approved': return 'bg-success';
      case 'pending': return 'bg-secondary';
      case 'denied': return 'bg-danger';
      default: return 'bg-dark';
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
      fetchStudents(); // refresh the list
    } catch (err) {
      console.error('Failed to update status', err);
    }
  };


  useEffect(() => {
    fetchStudents();
  }, []);

  return (
    <div className="container mt-5">
      <h2>Student List</h2>
      {students.length === 0 && <p>No students found</p>}
      <ul className="list-group">
        {students.map(student => (
          <li
            key={student.id}
            className="list-group-item d-flex justify-content-between align-items-center"
          >
            <div>
              <strong>{student.first_name} {student.last_name}</strong><br />
              <small>{student.email}</small>
            </div>

            <div className="d-flex align-items-center gap-2">
              <div className="dropdown me-2">
                <button
                  className={`btn btn-sm dropdown-toggle ${getBadgeClass(student.status)}`}
                  type="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  {student.status}
                </button>
                <ul className="dropdown-menu">
                  <li><button className="dropdown-item" onClick={() => updateStatus(student.id, 'approved')}>Approve</button></li>
                  <li><button className="dropdown-item" onClick={() => updateStatus(student.id, 'pending')}>Set Pending</button></li>
                  <li><button className="dropdown-item" onClick={() => updateStatus(student.id, 'denied')}>Deny</button></li>
                </ul>
              </div>

              <Link to={`/student/${student.id}`} className="btn btn-sm btn-info">
                <i className="bi bi-eye"></i>
              </Link>
              <Link to={`/student/edit/${student.id}`} className="btn btn-sm btn-warning">
                Edit
              </Link>
              <button
                onClick={() => deleteStudent(student.id)}
                className="btn btn-sm btn-danger"
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
