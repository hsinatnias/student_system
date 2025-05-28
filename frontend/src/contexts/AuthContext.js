import { createContext, useContext, useEffect, useState } from 'react';
import {jwtDecode} from 'jwt-decode';

const AuthContext = createContext();

export function AuthProvider({ children }) {
  const [token, setToken] = useState(localStorage.getItem('token') || null);
  const [user, setUser] = useState('');

  const login = (token) => {
    console.log('Token '+ token);
    localStorage.setItem('token', token);
    const decoded = decodeJWT(token);
    setUser(decoded);
    setToken(token)
  };

  const logout = () => {
    localStorage.removeItem('token');
    setToken(null);
    setUser(null);
  };
  useEffect(() => {    
    if(token){      
        const decoded = decodeJWT(token);
         setUser(decoded);      
    }
  },[token]);

  const decodeJWT = (jwt) => {
    try {
      const payload = jwt.split('.')[1];
      const decoded = JSON.parse(atob(payload));
      const now = Date.now()/1000;
      if(decoded.exp && decoded.exp < now){
        console.warn("Token expired");
        logout();
        return null;
      }
      return decoded;
    } catch (e) {
      return null;
    }
  };

  return (
    <AuthContext.Provider value={{ token, user, isAuthenticated: !!token, login, logout }}>
      {children}
    </AuthContext.Provider>
  );
}

export const useAuth = () => useContext(AuthContext);
