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
    <nav className="bg-gray-800 text-white py-4 shadow-md">
      
      <div className="container mx-auto flex flex-wrap items-center justify-between px-4">
        <Link to="/" className="no-underline text-2xl font-bold text-white hover:text-indigo-400 transition duration-200">
          StudentApp
        </Link>

        <div className="flex flex-wrap items-center gap-4">
          {isAuthenticated && user.role === "admin" && (
            <>
              <Link to="/dashboard" className="no-underline text-white border border-solid border-white px-3 py-1 hover:bg-white hover:text-gray-900 rounded text-sm transition">
                Dashboard
              </Link>
              <Link to="/students" className="no-underline text-white border border-solid border-white px-3 py-1 hover:bg-white hover:text-gray-900 rounded text-sm transition">
                Students
              </Link>
              <Link to="/add-student" className="no-underline text-white border border-solid border-white px-3 py-1 hover:bg-white hover:text-gray-900 rounded text-sm transition">
                Add Student
              </Link>
            </>
          )}

          {isAuthenticated && (
            <>
              <Link to="/profile" className="no-underline text-white border border-solid border-white px-3 py-1 hover:bg-white hover:text-gray-900 rounded text-sm transition">
                Profile
              </Link>
              <button
                onClick={handleLogout}
                className="px-3 py-1 bg-gray-600 hover:bg-white-700  hover:text-white text-white rounded text-sm transition"
              >
                Logout
              </button>
            </>
          )}

          {!isAuthenticated && (
            <>
              <Link
                to="/register"
                className="no-underline text-white border border-solid border-white px-3 py-1 hover:bg-white hover:text-gray-900 rounded text-sm transition"
              >
                Register
              </Link>
              <Link
                to="/login"
                className="no-underline text-white border border-solid border-white px-3 py-1 hover:bg-white hover:text-gray-900 rounded text-sm transition"
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
