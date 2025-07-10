import React, { useState, useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";
import { useAuth } from "../contexts/AuthContext";

export default function UnAuthorized() {

  return (
    <>
    <h1>You are not allowed..</h1>
    <Link className="badge badge-primary" to="/">
                  Please go back to home
                </Link>
    </>
    
  );
}
