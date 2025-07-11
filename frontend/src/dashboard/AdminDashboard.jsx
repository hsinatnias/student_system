import React, {Suspense} from 'react';
import { useAuth } from '../contexts/AuthContext';

const LazyCard = React.lazy(() => import('../Components/Card'));
export default function AdminDashboard() {
    const { user } = useAuth();

    


    if (user.role !== 'admin') {
        return <div className="container mt-5"><h4>Unauthorized</h4></div>;
    }

    return (
        <div className="px-4 py-8 max-w-6xl mx-auto">
          <h2 className="text-2xl font-semibold mb-6 text-gray-800">Admin Dashboard</h2>
      
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <Suspense fallback={<div>Loading card...</div>}>
              <LazyCard
                title="Courses"
                endpoint="/api/courses"
                renderItem={(c) => (
                  <li key={c.id} className="px-4 py-2 border-b last:border-none text-gray-700">
                    {c.name}
                  </li>
                )}
              />
            </Suspense>
          </div>
        </div>
      );
}
