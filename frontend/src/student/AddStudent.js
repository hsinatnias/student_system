import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useForm } from 'react-hook-form';
import axios from 'axios';

export default function AddStudent() {

  const {
    register,
    handleSubmit,
    formState: {errors},
    reset
  } = useForm();

  const navigate = useNavigate();

  const onSubmit = async (data) => {
    try{
      const token = localStorage.getItem('token');
      await axios.post('/api/student/create', data, {
        headers: {
          Authorization: `Bearer ${token}`
        },
      });
      alert("Student created successfully");
      reset();
      navigate('/students');
    }catch(error){
      alert("Error creating user");
      console.error(error);
    }
  };
  return (
    <div className="container mt-4">
      <h2>Add Student</h2>

      <form onSubmit={handleSubmit(onSubmit)} className="mt-3">

        <div className="mb-3">
          <label className="form-label">Name</label>
          <input
            {...register('name', { required: 'Name is required' })}
            className={`form-control ${errors.name ? 'is-invalid' : ''}`}
          />
          {errors.name && <div className="invalid-feedback">{errors.name.message}</div>}
        </div>

        <div className="mb-3">
          <label className="form-label">Email</label>
          <input
            {...register('email', {
              required: 'Email is required',
              pattern: {
                value: /^\S+@\S+$/i,
                message: 'Invalid email address'
              }
            })}
            className={`form-control ${errors.email ? 'is-invalid' : ''}`}
          />
          {errors.email && <div className="invalid-feedback">{errors.email.message}</div>}
        </div>

        <button type="submit" className="btn btn-primary">Add Student</button>
      </form>
    </div>
  );
}
