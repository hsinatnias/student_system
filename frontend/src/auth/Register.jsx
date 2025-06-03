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
        <div className="container mt-5">
            <h2>Add Student</h2>
            <form onSubmit={handleSubmit}>
                <div className="row">
                    <div className="mb-3 col-md-4">
                        <label>First Name</label>
                        <input
                            name="first_name"
                            type="text"
                            className="form-control"
                            value={form.first_name}
                            onChange={handleChange}
                            required
                        />
                    </div>
                    <div className="mb-3 col-md-4">
                        <label>Middle Name</label>
                        <input
                            name="middle_name"
                            type="text"
                            className="form-control"
                            value={form.middle_name}
                            onChange={handleChange}
                        />
                    </div>
                    <div className="mb-3 col-md-4">
                        <label>Last Name</label>
                        <input
                            name="last_name"
                            type="text"
                            className="form-control"
                            value={form.last_name}
                            onChange={handleChange}
                            required
                        />
                    </div>
                </div>

                <div className="mb-3">
                    <label>Email</label>
                    <input
                        name="email"
                        type="email"
                        className="form-control"
                        value={form.email}
                        onChange={handleChange}
                        required
                    />
                </div>

                <div className="mb-3">
                    <label>Password</label>
                    <input
                        name="password"
                        type="password"
                        className="form-control"
                        value={form.password}
                        onChange={handleChange}
                        required
                    />
                </div>
                <div className="mb-3">
                    <label>Confirm Password</label>
                    <input
                        name="confirm_password"
                        type="password"
                        className="form-control"
                        value={form.confirm_password}
                        onChange={handleChange}
                        required
                    />
                </div>

                <div className="row">
                    <div className="mb-3 col-md-4">
                        <label>Year of Admission (e.g., 2024)</label>
                        <input
                            name="year"
                            type="number"
                            className="form-control"
                            value={form.year}
                            onChange={handleChange}
                            required
                        />
                    </div>
                    <div className="mb-3 col-md-4">
                        <label>Date of Birth</label>
                        <input
                            name="date_of_birth"
                            type="date"
                            className="form-control"
                            value={form.date_of_birth}
                            onChange={handleChange}
                            required
                        />
                    </div>
                    <div className="mb-3 col-md-4">
                        <label>Gender</label>
                        <select
                            name="gender"
                            className="form-select"
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

                <div className="row">
                    <div className="mb-3 col-md-6">
                        <label>Course</label>
                        <select
                            name="course_id"
                            className="form-select"
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
                    <div className="mb-3 col-md-6">
                        <label>Department</label>
                        <select
                            name="department_id"
                            className="form-select"
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

                <div className="mt-4">
                    <button className="btn btn-success" type="submit">Submit</button>
                </div>
            </form>
        </div>

    );
}
