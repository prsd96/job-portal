<!-- JobPostingForm.vue -->
<template>
  <div>
    <h2>Create Job</h2>
    <form @submit.prevent="submitForm">
      <input type="text" v-model="jobTitle" placeholder="Job Title" required>
      <input type="text" v-model="companyName" placeholder="Company Name" required>
      <input type="text" v-model="location" placeholder="Location" required>
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
/* Component styles */
</style>
