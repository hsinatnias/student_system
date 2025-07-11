import axios from "axios";
import { useEffect, useState } from "react"

export default function Card({title, endpoint, renderItem}){
    const token = localStorage.getItem('token');
    const [details, setDetails] = useState([]);

    useEffect(()=>{
        axios.get(endpoint, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        })
        .then(res => setDetails(res.data))
        .catch(err => console.error(`${title} load error`, err));
    },[endpoint]);

    
    
    return (
        <div className="w-72 rounded-lg shadow-lg border border-gray-200 bg-white p-4 transition hover:shadow-xl">
          <div className="mb-4">
            <h5 className="text-lg font-bold text-gray-800">{title}</h5>
          </div>
      
          <ul className="mb-4 space-y-1">
            {details.map(renderItem)}
          </ul>
      
          <a href="#" className="inline-block text-center w-full box-border border- px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Go To
          </a>
        </div>
      );
      
}