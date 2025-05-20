// frontend/src/AddStudent.js
import React, { useState } from 'react';
import axios from 'axios';

export default function AddStudent() {
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [status, setStatus] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();
    const token = localStorage.getItem('token');

    try {
      const res = await axios.post('/api/student/create', {
        name, email
      }, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      });

      setStatus('Student created successfully!');
      setName('');
      setEmail('');
    } catch (err) {
      console.error(err);
      setStatus('Failed to create student');
    }
  };

  return (
    <div className="container mt-5">
      <h2>Add Student</h2>
      {status && <div className="alert alert-info">{status}</div>}
      <form onSubmit={handleSubmit}>
        <div className="mb-3">
          <label>Name:</label>
          <input className="form-control" value={name} onChange={(e) => setName(e.target.value)} required />
        </div>
        <div className="mb-3">
          <label>Email:</label>
          <input className="form-control" type="email" value={email} onChange={(e) => setEmail(e.target.value)} required />
        </div>
        <button className="btn btn-primary">Add Student</button>
      </form>
    </div>
  );
}
