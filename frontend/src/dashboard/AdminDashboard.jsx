import React, {Suspense} from 'react';
import { useAuth } from '../contexts/AuthContext';

const LazyCard = React.lazy(() => import('../Components/Card'));
export default function AdminDashboard() {
    const { user } = useAuth();

    


    if (user.role !== 'admin') {
        return <div className="container mt-5"><h4>Unauthorized</h4></div>;
    }

    return (
        <div className="container mt-5">
            <h2>Admin Dashboard</h2>
            <div className="row">
                <Suspense fallback={<div>Loading card...</div>}>
                <LazyCard 
                        title="Courses"
                        endpoint="/api/courses"
                        renderItem={(c) => <li key={c.id} className="list-group-item">{c.name}</li>}
                />
                </Suspense>
                
            </div>


        </div>
    );
}
