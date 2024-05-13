<template>
  <div>
    <h2>Job Details</h2>
    <!-- Display job data here -->
    <div v-if="jobData">
      <p><strong>Job Title:</strong> {{ jobData.job.job_title }}</p>
      <p><strong>Company:</strong> {{ jobData.job.company_name }}</p>
      <p><strong>Location:</strong> {{ jobData.job.location }}</p>
      <!-- Add more job details as needed -->
    </div>
    <!-- Button to apply for the job -->
    <button @click="applyForJob" v-if="jobData">Apply for Job</button>
    <!-- Display confirmation message -->
    <div v-if="showConfirmation">
      <p>Application submitted successfully!</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import API_BASE_URL from '@/config.js';

export default {
  data() {
    return {
      jobData: null,
      showConfirmation: false
    };
  },
  mounted() {
    this.fetchJobData();
  },
  methods: {
    fetchJobData() {
      const token = localStorage.getItem('token');
      const jobId = this.$route.params.jobId;
      console.log('Fetching job data for jobId:', jobId);
      axios.post(`${API_BASE_URL}/job-data`, { job_id: jobId }, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      })
      .then(response => {
        console.log('Job data response:', response.data);
        this.jobData = response.data;
      })
      .catch(error => {
        console.error('Error fetching job data:', error);
        this.loadingError = true; // Set loading error flag
      });
    },
    applyForJob() {
      const token = localStorage.getItem('token');
      const jobId = this.jobData.job.id; // Assuming job ID is accessible in jobData
      axios.post(`${API_BASE_URL}/job-apply`, { job_id: jobId }, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      })
      .then(() => {
        // Show confirmation message
        this.showConfirmation = true;
      })
      .catch(error => {
        console.error('Error applying for job:', error);
      });
    }
  }
}
</script>

<style scoped>
/* Component styles */
</style>
