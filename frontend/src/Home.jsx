import React, { useEffect, useState } from 'react';
import axios from 'axios';

export default function Home() {
  const [data, setData] = useState(null);
  const token = localStorage.getItem('token');

  useEffect(() => {
    axios.get('/api/student',{
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
      .then(response => setData(response.data))
      .catch(error => console.error(error));
  }, []);

  return (
    <div>
      <h1>Home Page</h1>
      {data && <pre>{JSON.stringify(data, null, 2)}</pre>}
    </div>
  );
}
