import React, { useEffect, useState } from 'react';
import axios from 'axios';

export default function UserProfile() {
  const [user, setUser] = useState(null);
  const [error, setError] = useState('');

  useEffect(() => {
    const token = localStorage.getItem('token');

    axios.get('/api/auth/me', {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
    .then(response => {
      setUser(response.data.user);
    })
    .catch(err => {
      console.error('Error fetching user profile:', err);
      setError('Failed to load user profile.');
    });
  }, []);

  return (
    <div className="container mt-4">
      <h2>User Profile</h2>
      {error && <div className="alert alert-danger">{error}</div>}
      {user ? (
        <div className="card p-3 shadow-sm">
          <p><strong>Email:</strong> {user.email}</p>
          <p><strong>Role:</strong> {user.role}</p>
        </div>
      ) : (
        !error && <p>Loading user info...</p>
      )}
    </div>
  );
}
