import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useParams, useNavigate } from 'react-router-dom';

export default function EditStudent() {
  const [courses, setCourses] = useState([]);
  const [departments, setDepartments] = useState([]);

  const { id } = useParams();
  const navigate = useNavigate();
  const [form, setForm] = useState({
    first_name: '',
    middle_name: '',
    last_name: '',
    email: '',
    password: '',
    year: '',
    date_of_birth: '',
    gender: '',
    course_id: '',
    department_id: ''
  });

  useEffect(() => {
    const token = localStorage.getItem('token');
    axios.get(`/api/student/show?id=${id}`, {
      headers: { Authorization: `Bearer ${token}` }
    })
      .then(res => setForm(res.data))
      .catch(err => console.error(err));
    axios.get('/api/courses', { headers: { Authorization: `Bearer ${token}` } })
      .then(res => setCourses(res.data))
      .catch(err => console.error('Course load error', err));

    axios.get('/api/departments', { headers: { Authorization: `Bearer ${token}` } })
      .then(res => setDepartments(res.data))
      .catch(err => console.error('Department load error', err));
  }, [id]);

  const handleChange = e => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = e => {
    e.preventDefault();
    const token = localStorage.getItem('token');
    axios.post(`/api/student/update?id=${id}`, form, {
      headers: { Authorization: `Bearer ${token}` }
    })
      .then(() => navigate('/students'))
      .catch(err => console.error(err));
  };

  return (
    <div className="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">
      <h2 className="text-2xl font-semibold mb-6 text-center">Edit Student</h2>
      <form onSubmit={handleSubmit} className="space-y-6">
  
        {/* Name Fields */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label className="block mb-1 font-medium">First Name</label>
            <input
              name="first_name"
              type="text"
              className="w-full border rounded px-3 py-2"
              value={form.first_name}
              onChange={handleChange}
              required
            />
          </div>
          <div>
            <label className="block mb-1 font-medium">Middle Name</label>
            <input
              name="middle_name"
              type="text"
              className="w-full border rounded px-3 py-2"
              value={form.middle_name}
              onChange={handleChange}
            />
          </div>
          <div>
            <label className="block mb-1 font-medium">Last Name</label>
            <input
              name="last_name"
              type="text"
              className="w-full border rounded px-3 py-2"
              value={form.last_name}
              onChange={handleChange}
              required
            />
          </div>
        </div>
  
        {/* Email */}
        <div>
          <label className="block mb-1 font-medium">Email</label>
          <input
            name="email"
            type="email"
            className="w-full border rounded px-3 py-2"
            value={form.email}
            onChange={handleChange}
            required
          />
        </div>
  
        {/* Password */}
        <div>
          <label className="block mb-1 font-medium">Password</label>
          <input
            name="password"
            type="password"
            className="w-full border rounded px-3 py-2"
            onChange={handleChange}
            required
          />
        </div>
  
        {/* Year / DOB / Gender */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label className="block mb-1 font-medium">Year of Admission</label>
            <input
              name="year"
              type="number"
              className="w-full border rounded px-3 py-2"
              value={form.year}
              onChange={handleChange}
              required
            />
          </div>
          <div>
            <label className="block mb-1 font-medium">Date of Birth</label>
            <input
              name="date_of_birth"
              type="date"
              className="w-full border rounded px-3 py-2"
              value={form.date_of_birth}
              onChange={handleChange}
              required
            />
          </div>
          <div>
            <label className="block mb-1 font-medium">Gender</label>
            <select
              name="gender"
              className="w-full border rounded px-3 py-2"
              value={form.gender}
              onChange={handleChange}
              required
            >
              <option value="">Select Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
          </div>
        </div>
  
        {/* Course / Department */}
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label className="block mb-1 font-medium">Course</label>
            <select
              name="course_id"
              className="w-full border rounded px-3 py-2"
              value={form.course_id}
              onChange={handleChange}
              required
            >
              <option value="">Select Course</option>
              {courses.map(c => (
                <option key={c.id} value={c.id}>{c.name}</option>
              ))}
            </select>
          </div>
          <div>
            <label className="block mb-1 font-medium">Department</label>
            <select
              name="department_id"
              className="w-full border rounded px-3 py-2"
              value={form.department_id}
              onChange={handleChange}
              required
            >
              <option value="">Select Department</option>
              {departments.map(d => (
                <option key={d.id} value={d.id}>{d.name}</option>
              ))}
            </select>
          </div>
        </div>
  
        {/* Hidden Enrollment Number */}
        <input
          type="hidden"
          name="enrollment_number"
          value={form.enrollment_number}
        />
  
        {/* Submit Button */}
        <div className="text-center">
          <button
            type="submit"
            className="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded transition"
          >
            Submit
          </button>
        </div>
      </form>
    </div>
  );
  
}
