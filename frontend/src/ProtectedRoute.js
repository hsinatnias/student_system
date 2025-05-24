import React from "react";
import { Navigate } from 'react-router-dom';
import { useAuth } from "./contexts/AuthContext";

export default function ProtectedRoute({ children, roles = [] }){
  const { isLoggedIn, user } = useAuth();

  if(!isLoggedIn) return <Navigate to="/login" />
  if(roles.length > 0 && !roles.includes(user.role)){
    return <Navigate to="/unauthorized" />
  }
    
  return children;
}