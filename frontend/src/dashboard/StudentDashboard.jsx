import React from 'react';
import { useAuth } from '../contexts/AuthContext';

export default function StudentDashboard() {
    const { user } = useAuth();

    return (
        <div className="px-4 py-8 max-w-4xl mx-auto">
          <h2 className="text-2xl font-bold text-gray-800 mb-4">Student Dashboard</h2>
          <p className="text-gray-700 mb-2">Welcome, <span className="font-medium">{user.email}</span>!</p>
          <p className="text-gray-700">Your User ID: <span className="font-mono text-blue-600">{user.userID}</span></p>
        </div>
      );
}

