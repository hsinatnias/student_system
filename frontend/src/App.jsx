import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Dashboard from './Dashboard';
import Home from './Home';
import Login from './Login';
import protectedRoute from './ProtectedRoute';

export default function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/login" element={<Login />} />
        <Route path="/dashboard" 
        element={
          <protectedRoute>
            <Dashboard />
          </protectedRoute>
      } 
        />
      </Routes>
    </Router>
  );
}
