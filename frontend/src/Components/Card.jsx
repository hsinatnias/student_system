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
            <div className='card' style={{width: "18rem"}}>
                <div className="card-body">
                    <h5 className="card-title">{title}</h5>
                    <ul className="list-group list-group-flush">
                        {details.map(renderItem)}
                    </ul>
                    <a href="#" className='btn btn-primary'>Go To</a>
                </div>

            </div>
        );
}