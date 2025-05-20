// frontend/src/StudentList.js
import React, { useEffect, useState } from 'react';
import axios from 'axios';

export default function StudentList() {
  const [students, setStudents] = useState([]);

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

  useEffect(() => {
    fetchStudents();
  }, []);

  return (
    <div className="container mt-5">
      <h2>Student List</h2>
      {students.length === 0 && <p>No students found</p>}
      <ul className="list-group">
        {students.map(student => (
          <li key={student.id} className="list-group-item d-flex justify-content-between align-items-center">
            {student.name} - {student.email}
            <button className="btn btn-danger btn-sm" onClick={() => deleteStudent(student.id)}>Delete</button>
          </li>
        ))}
      </ul>
    </div>
  );
}
