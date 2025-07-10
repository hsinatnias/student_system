import React from "react";
import { Link, useNavigate } from "react-router-dom";
import { useAuth } from "../contexts/AuthContext";

export default function Navbar() {
  const { user, isAuthenticated, logout } = useAuth();
  const navigate = useNavigate();

  const handleLogout = () => {
    logout();
    navigate("/");
  };

  return (
    <nav className="bg-gray-800 text-white px-4 py-3 shadow-md">
      
      <div className="container mx-auto flex flex-wrap items-center justify-between">
        <Link to="/" className="text-xl font-semibold text-white">
          StudentApp
        </Link>

        <div className="flex flex-wrap items-center space-x-4">
          {isAuthenticated && user.role === "admin" && (
            <>
              <Link to="/dashboard" className="hover:text-blue-300">
                Dashboard
              </Link>
              <Link to="/students" className="hover:text-blue-300">
                Students
              </Link>
              <Link to="/add-student" className="hover:text-blue-300">
                Add Student
              </Link>
            </>
          )}

          {isAuthenticated && (
            <>
              <Link to="/profile" className="hover:text-blue-300">
                Profile
              </Link>
              <button
                onClick={handleLogout}
                className="ml-2 px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm transition"
              >
                Logout
              </button>
            </>
          )}

          {!isAuthenticated && (
            <>
              <Link
                to="/register"
                className="px-3 py-1 border border-white hover:bg-white hover:text-gray-800 rounded text-sm transition"
              >
                Register
              </Link>
              <Link
                to="/login"
                className="ml-2 px-3 py-1 border border-white hover:bg-white hover:text-gray-800 rounded text-sm transition"
              >
                Login
              </Link>
            </>
          )}
        </div>
      </div>
    </nav>
  );
}
