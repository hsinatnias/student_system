import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Dashboard from './dashboard/Dashboard';
import Home from './Home';
import Login from './Login';
import AddStudent from './AddStudent';
import StudentList from './StudentList';
import ProtectedRoute from './ProtectedRoute';
import Navbar from './Navbar';
import EditStudent from './EditStudent';
import StudentDetails from './StudentDetails';

export default function App() {
  return (
    <Router>
      <Navbar/>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/login" element={<Login />} />

        <Route
          path="/dashboard"
          element={
            <ProtectedRoute>
              <Dashboard />
            </ProtectedRoute>
          }
        />

        <Route
          path="/students"
          element={
            <ProtectedRoute>
              <StudentList />
            </ProtectedRoute>
          }
        />

        <Route
          path="/add-student"
          element={
            <ProtectedRoute>
              <AddStudent />
            </ProtectedRoute>
          }
        />
        <Route 
          path="/students/edit/:id" 
          element={
          <ProtectedRoute>
            <EditStudent />
          </ProtectedRoute>
          } />
          <Route 
            path="/student/:id" 
            element={
              <ProtectedRoute>
                <StudentDetails />
              </ProtectedRoute>                
            } />
      </Routes>
    </Router>
  );
}
