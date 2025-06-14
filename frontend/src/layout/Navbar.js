import React, { useState, useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";
import { useAuth } from "../contexts/AuthContext";

export default function Navbar() {
  // const [isLoggedIn, setIsLoggedIn] = useState(false);
  const { user, isAuthenticated, logout } = useAuth();
  const navigate = useNavigate();

  const handleLogout = () => {
    logout();
    navigate("/");
  };

  return (
    <nav className="navbar navbar-expand-lg navbar-dark bg-dark px-4">
      <Link className="navbar-brand" to="/">
        StudentApp
      </Link>

      <button
        className="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
      >
        <span className="navbar-toggler-icon"></span>
      </button>

      <div className="collapse navbar-collapse" id="navbarNav">
        <ul className="navbar-nav ms-auto">
          {isAuthenticated && user.role === 'admin' && (
            <>

              <li className="nav-item">
                <Link className="nav-link" to="/dashboard">
                  Dashboard
                </Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link" to="/students">
                  Students
                </Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link" to="/add-student">
                  Add Student
                </Link>
              </li>

            </>
          )}
          {isAuthenticated && (
            <>
              <li className="nav-item">
                <Link className="nav-link" to="/dashboard">
                  Dashboard
                </Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link" to="/profile">
                  Profile
                </Link>
              </li>
              <li className="nav-item">
                <button
                  className="btn btn-sm btn-outline-light ms-3"
                  onClick={handleLogout}
                >
                  Logout
                </button>
              </li>
            </>
          )}


          {!isAuthenticated && (
            <>
              <li className="nav-item">
                <Link className="btn btn-sm btn-outline-light ms-3" to="/register">
                  Register
                </Link>
              </li>
              <li className="nav-item">
                <Link className="btn btn-sm btn-outline-light ms-3" to="/login">
                  Login
                </Link>
              </li>
            </>

          )}
        </ul>
      </div>
    </nav>
  );
}
