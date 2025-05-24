import React from 'react';
import { useAuth } from '../contexts/AuthContext';

export default function AdminDashboard() {
    const { user } = useAuth();
    

  if (user.role !== 'admin') {
        return <div className="container mt-5"><h4>Unauthorized</h4></div>;
    }

    return (
        <div className="container mt-5">
            <h2>Admin Dashboard</h2>
            <p>Welcome, Admin! Manage users and students here.</p>
        </div>
    );
}
