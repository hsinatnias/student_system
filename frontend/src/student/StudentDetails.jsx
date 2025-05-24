import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import axios from 'axios';
import { Link } from 'react-router-dom';

export default function StudentDetails() {
  const { id } = useParams();
  const [student, setStudent] = useState(null);

  useEffect(() => {
    const token = localStorage.getItem('token');
    axios
      .get(`/api/student/show?id=${id}`, {
        headers: { Authorization: `Bearer ${token}` }
      })
      .then(res => setStudent(res.data))
      .catch(err => console.error(err));
  }, [id]);

  if (!student) return <p>Loading...</p>;

  return (
    <div className="container mt-5">
      <h2>Student Details</h2>
      <p><strong>ID:</strong> {student.id}</p>
      <p><strong>Name:</strong> {student.name}</p>
      <p><strong>Email:</strong> {student.email}</p>
      <Link to="/students" className="btn btn-secondary mt-3">Back to List</Link>
    </div>
  );
}
