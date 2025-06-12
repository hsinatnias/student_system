import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useAuth } from '../contexts/AuthContext';
import { Navigate } from 'react-router-dom';
import AdminDashboard from './AdminDashboard';
import StudentDashboard from './StudentDashboard';

export default function Dashboard() {
  const {user} = useAuth();

  if(!user) return <Navigate to="/login" />;

  if(user.role === 'admin') return <AdminDashboard/>;
  if(user.role === 'student') return <StudentDashboard/>;

  return (
    <div className="container mt-5">
      <h2>Unauthorized</h2>
      <p>Your role is not authorized to access this page.</p>
    </div>
  );
}
