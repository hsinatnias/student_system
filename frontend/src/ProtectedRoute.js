import React from "react";
import { Navigate } from 'react-router-dom';
import { useAuth } from "./contexts/AuthContext";

export default function ProtectedRoute({ children, roles = [] }){
  const { isAuthenticated, user, loading } = useAuth();

  if(loading){
    return <div className="text-center mt-5">Checking authentication...</div>;
  }
  if(!isAuthenticated || !user) return <Navigate to="/login" replace />
  if(roles.length > 0 && !roles.includes(user.role)){
    return <Navigate to="/unauthorized" />
  }
    
  return children;
}