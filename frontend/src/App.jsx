import React from "react";
import { BrowserRouter as Router, Routes, Route, useLocation } from "react-router-dom";
import Dashboard from "./dashboard/Dashboard";
import Home from "./Home";
import Login from "./auth/Login";
import AddStudent from "./student/AddStudent";
import StudentList from "./student/StudentList";
import ProtectedRoute from "./ProtectedRoute";
import Navbar from "./layout/Navbar";
import EditStudent from "./student/EditStudent";
import StudentDetails from "./student/StudentDetails";
import UserProfile from "./user/UserProfile";
import AdminDashboard from "./dashboard/AdminDashboard";
import StudentDashboard from "./dashboard/StudentDashboard";
import UnAuthorized from "./layout/UnAuthorized";
import Register from "./auth/Register";

function AppRoutes(){
  const location = useLocation();
  return(
    <>
    {location.pathname !== "/login" && <Navbar/>}
    <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="/unauthorized" element={<UnAuthorized />} />

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
          path="/student/edit/:id"
          element={
            <ProtectedRoute>
              <EditStudent />
            </ProtectedRoute>
          }
        />
        <Route
          path="/student/:id"
          element={
            <ProtectedRoute>
              <StudentDetails />
            </ProtectedRoute>
          }
        />
        <Route
          path="/profile"
          element={
            <ProtectedRoute>
              <UserProfile />
            </ProtectedRoute>
          }
        />
        <Route
          path="/admin"
          element={
            <ProtectedRoute>
              <AdminDashboard/>
            </ProtectedRoute>
          }
        />
        <Route 
          path="/studentdashboard"
          element={
            <ProtectedRoute>
              <StudentDashboard/>
            </ProtectedRoute>
          }
        />
      </Routes>
    </>
  );
}

export default function App() {
  return (
    <Router>
      <AppRoutes />
    </Router>
  );
}
