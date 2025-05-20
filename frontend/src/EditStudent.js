import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useParams, useNavigate } from 'react-router-dom';

export default function EditStudent() {
  const [form, setForm] = useState({ name: '', email: '' });
  const { id } = useParams();
  const navigate = useNavigate();

  useEffect(() => {
    const token = localStorage.getItem('token');
    axios.get(`/api/student/show?id=${id}`, {
      headers: { Authorization: `Bearer ${token}` }
    })
    .then(res => setForm(res.data))
    .catch(err => console.error(err));
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
    <div>
      <h2>Edit Student</h2>
      <form onSubmit={handleSubmit}>
        <input type="text" name="name" value={form.name} onChange={handleChange} className="form-control mb-2" />
        <input type="email" name="email" value={form.email} onChange={handleChange} className="form-control mb-2" />
        <button className="btn btn-primary">Update</button>
      </form>
    </div>
  );
}
