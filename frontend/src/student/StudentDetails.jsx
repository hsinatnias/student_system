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
  console.log(student);

  return (
    <div className="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">
      <h2 className="text-2xl font-semibold mb-6 text-center">Student Details</h2>
      <div className="space-y-4 text-lg">
        <p><strong className="text-gray-700">ID:</strong> {student.id}</p>
        <p><strong className="text-gray-700">First Name:</strong> {student.first_name}</p>
        <p><strong className="text-gray-700">Last Name:</strong> {student.last_name}</p>
        <p><strong className="text-gray-700">Email:</strong> {student.email}</p>
      </div>
  
      <div className="mt-6">
        <Link
          to="/students"
          className="inline-block px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded transition"
        >
          Back to List
        </Link>
      </div>
    </div>
  );
  
}
