import React, { useEffect, useState } from 'react';
import axios from 'axios';

export default function Dashboard() {
  const [message, setMessage] = useState('Loading...');

  useEffect(() => {
    const token = localStorage.getItem('token');
    

    axios.get('/api/auth/protected', {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
    .then(response => {
      setMessage("Welcome!");
    })
    .catch(error => {
      console.error('API error:', error);
      setMessage('Access denied');
    });
  }, []);

  return (
    <div>
      <h1>Dashboard</h1>
      <p>{message}</p>
    </div>
  );
}
