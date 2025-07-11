import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useNavigate, Navigate } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';


export default function Register() {
    const navigate = useNavigate();
    const [courses, setCourses] = useState([]);
    const [departments, setDepartments] = useState([]);

    const [form, setForm] = useState({
        first_name: '',
        middle_name: '',
        last_name: '',
        email: '',
        password: '',
        confirm_password: '',
        year: '',
        date_of_birth: '',
        gender: '',
        course_id: '',
        department_id: ''
    });



    useEffect(() => {
        const token = localStorage.getItem('token');
        axios.get('/api/courses', { headers: { Authorization: `Bearer ${token}` } })
            .then(res => setCourses(res.data))
            .catch(err => console.error('Course load error', err));

        axios.get('/api/departments', { headers: { Authorization: `Bearer ${token}` } })
            .then(res => setDepartments(res.data))
            .catch(err => console.error('Department load error', err));
    }, []);

    const handleChange = e => {
        const { name, value } = e.target;
        setForm(prev => ({ ...prev, [name]: value }));
    };

    const handleSubmit = async e => {
        e.preventDefault();

        if (form.password !== form.confirm_password) {
            alert("Passwords do not match!");
            return;
        }
        const { confirm_password, ...formData } = form;
        const token = localStorage.getItem('token');
        try {
            await axios.post('/api/auth/register', form);
            navigate('/login');
        } catch (err) {
            console.error('Failed to create student', err);
        }
    };

    

    return (
        <div className="min-h-screen flex justify-center items-center bg-gray-50 px-4 py-8">
          <div className="w-full max-w-4xl bg-white p-8 rounded shadow-md">
            <h2 className="text-2xl font-bold text-center mb-6">Add Student</h2>
      
            <form onSubmit={handleSubmit} className="space-y-6">
              <div className="grid md:grid-cols-3 gap-4">
                <div>
                  <label className="block mb-1 font-semibold">First Name</label>
                  <input
                    name="first_name"
                    type="text"
                    className="w-full box-border border px-3 py-2 rounded"
                    value={form.first_name}
                    onChange={handleChange}
                    required
                  />
                </div>
                <div>
                  <label className="block mb-1 font-semibold">Middle Name</label>
                  <input
                    name="middle_name"
                    type="text"
                    className="w-full box-border border px-3 py-2 rounded"
                    value={form.middle_name}
                    onChange={handleChange}
                  />
                </div>
                <div>
                  <label className="block mb-1 font-semibold">Last Name</label>
                  <input
                    name="last_name"
                    type="text"
                    className="w-full box-border border px-3 py-2 rounded"
                    value={form.last_name}
                    onChange={handleChange}
                    required
                  />
                </div>
              </div>
      
              <div className="grid md:grid-cols-2 gap-4">
                <div>
                  <label className="block mb-1 font-semibold">Email</label>
                  <input
                    name="email"
                    type="email"
                    className="w-full box-border border px-3 py-2 rounded"
                    value={form.email}
                    onChange={handleChange}
                    required
                  />
                </div>
                <div>
                  <label className="block mb-1 font-semibold">Year of Admission</label>
                  <input
                    name="year"
                    type="number"
                    className="w-full box-border border px-3 py-2 rounded"
                    value={form.year}
                    onChange={handleChange}
                    required
                  />
                </div>
              </div>
      
              <div className="grid md:grid-cols-2 gap-4">
                <div>
                  <label className="block mb-1 font-semibold">Password</label>
                  <input
                    name="password"
                    type="password"
                    className="w-full box-border border px-3 py-2 rounded"
                    value={form.password}
                    onChange={handleChange}
                    required
                  />
                </div>
                <div>
                  <label className="block mb-1 font-semibold">Confirm Password</label>
                  <input
                    name="confirm_password"
                    type="password"
                    className="w-full box-border border px-3 py-2 rounded"
                    value={form.confirm_password}
                    onChange={handleChange}
                    required
                  />
                </div>
              </div>
      
              <div className="grid md:grid-cols-2 gap-4">
                <div>
                  <label className="block mb-1 font-semibold">Date of Birth</label>
                  <input
                    name="date_of_birth"
                    type="date"
                    className="w-full box-border border px-3 py-2 rounded"
                    value={form.date_of_birth}
                    onChange={handleChange}
                    required
                  />
                </div>
                <div>
                  <label className="block mb-1 font-semibold">Gender</label>
                  <select
                    name="gender"
                    className="w-full box-border border px-3 py-2 rounded"
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
      
              <div className="grid md:grid-cols-2 gap-4">
                <div>
                  <label className="block mb-1 font-semibold">Course</label>
                  <select
                    name="course_id"
                    className="w-full border px-3 py-2 rounded"
                    value={form.course_id}
                    onChange={handleChange}
                    required
                  >
                    <option value="">Select Course</option>
                    {courses.map((c) => (
                      <option key={c.id} value={c.id}>
                        {c.name}
                      </option>
                    ))}
                  </select>
                </div>
                <div>
                  <label className="block mb-1 font-semibold">Department</label>
                  <select
                    name="department_id"
                    className="w-full border px-3 py-2 rounded"
                    value={form.department_id}
                    onChange={handleChange}
                    required
                  >
                    <option value="">Select Department</option>
                    {departments.map((d) => (
                      <option key={d.id} value={d.id}>
                        {d.name}
                      </option>
                    ))}
                  </select>
                </div>
              </div>
      
              <div className="text-center">
                <button
                  type="submit"
                  className="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition"
                >
                  Submit
                </button>
              </div>
            </form>
          </div>
        </div>
      );
      
}
