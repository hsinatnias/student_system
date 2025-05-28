import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useAuth } from './contexts/AuthContext';

export default function Home() {
   const { isAuthenticated, logout } = useAuth();
   const[user, setUser] = useState('');
   
    
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
      
    });
    }, []);
  return (
    <div>
      <h1>Home Page</h1>
      {user && (
        <>
          <h2> Welcome {user.first_name}!</h2>
          <h2>{user.email}</h2>
          <h2>{user.role}</h2>
        </>
      )}
      {!user && (
        <>
          Welcome guest! Please register or login.
        </>
      )}
      
    </div>
  );
}
