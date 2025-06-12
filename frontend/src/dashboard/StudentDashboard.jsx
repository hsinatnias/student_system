import React from 'react';
import { useAuth } from '../contexts/AuthContext';

export default function StudentDashboard() {
    const { user } = useAuth();

    return (
        <div className="container mt-5">
            <h2>Student Dashboard</h2>
            <p>Welcome, {user.email}!</p>
            <p>Your User ID: {user.userID}</p>
        </div>
    );
}

