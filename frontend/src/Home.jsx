import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useAuth } from './contexts/AuthContext';

export default function Home() {
   const { user } = useAuth();
   
   
  return (
    <div>
      <h1>Home Page</h1>
      {user && (
        <>
          <h2> Welcome {user.first_name}!</h2>
          <h2>{user.email}</h2>
          <h2>{user.role}</h2>
        </>
      )}
      {!user && (
        <>
          Welcome guest! Please <a href='/register'>register</a> or <a href='/login'>login</a>.
        </>
      )}
      
    </div>
  );
}
