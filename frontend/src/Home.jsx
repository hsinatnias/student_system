import React, { useEffect, useState } from "react";
import axios from "axios";
import { useAuth } from "./contexts/AuthContext";
import { Link } from "react-router-dom";

export default function Home() {
  const { user } = useAuth();

  return (
    <div className="min-h-screen flex flex-col items-center justify-center text-center bg-gray-50 px-4">
      <h1 className="text-4xl font-bold text-indigo-700 mb-6">Home Page</h1>
      {user && (
        <div className="space-y-2 text-lg text-gray-700">
          <h2 className="text-2xl font-semibold text-green-600">
            {" "}
            Welcome {user.first_name}!
          </h2>
          <p>{user.email}</p>
          <h2 className="capitalize">{user.role}</h2>
        </div>
      )}
      {!user && (
        <p className="text-lg text-gray-600">
          Welcome guest! Please{" "}
          <Link to="/register" className="no-underline text-blue-600 hover:underline">
            Register
          </Link>{" "}
          or{" "}
          <Link to="/login" className="no-underline text-blue-600 hover:underline">
            Login
          </Link>
        </p>
      )}
    </div>
  );
}
