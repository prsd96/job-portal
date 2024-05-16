<template>
  <div class="job-posting-form">
    <h2>Create Job</h2>
    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label for="jobTitle">Job Title</label>
        <input type="text" id="jobTitle" v-model="jobTitle" placeholder="Job Title" required>
      </div>
      <div class="form-group">
        <label for="companyName">Company Name</label>
        <input type="text" id="companyName" v-model="companyName" placeholder="Company Name" required>
      </div>
      <div class="form-group">
        <label for="location">Location</label>
        <input type="text" id="location" v-model="location" placeholder="Location" required>
      </div>
      <!-- You can add more input fields for additional job details -->
      <button type="submit">Submit</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';
import API_BASE_URL from '@/config.js';

export default {
  data() {
    return {
      jobTitle: '',
      companyName: '',
      location: ''
      // Add more data properties for additional job details
    };
  },
  methods: {
    submitForm() {
      const token = localStorage.getItem('token');
      axios.post(`${API_BASE_URL}/save-job`, {
        job_title: this.jobTitle,
        company_name: this.companyName,
        location: this.location,
        // Pass additional job details as needed
      }, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      })
      .then(response => {
        // Handle successful job creation
        console.log('Job created successfully:', response.data);
        // Redirect to the job listing page
        this.$router.push('/jobs');
      })
      .catch(error => {
        // Handle job creation error
        console.error('Error creating job:', error);
      });
    }
  }
}
</script>

<style scoped>
.job-posting-form {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  background: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.job-posting-form h2 {
  text-align: center;
  margin-bottom: 20px;
  color: #333;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
  color: #333;
}

.form-group input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

button[type="submit"] {
  width: 100%;
  padding: 10px;
  background-color: #3498db;
  border: none;
  border-radius: 4px;
  color: white;
  font-size: 16px;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #2980b9;
}
</style>
