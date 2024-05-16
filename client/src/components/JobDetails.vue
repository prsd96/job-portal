<template>
  <div class="job-details-container">
    <h2>Job Details</h2>
    <!-- Display job data here -->
    <div v-if="jobData" class="job-details">
      <p><strong>Job Title:</strong> <br> {{ jobData.job.job_title }}</p>
      <p><strong>Company:</strong> <br> {{ jobData.job.company_name }}</p>
      <p><strong>Location:</strong> <br> {{ jobData.job.location }}</p>
      <!-- Add more job details as needed -->
    </div>
    <!-- Button to apply for the job -->
    <button @click="applyForJob" v-if="jobData" class="apply-button">Apply for Job</button>
    <!-- Display confirmation message -->
    <div v-if="showConfirmation" class="confirmation-message">
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
.job-details-container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  background: #f9f9f9;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  color: #2c3e50;
  margin-bottom: 20px;
}

.job-details p {
  margin: 10px 0;
  font-size: 16px;
  line-height: 1.5;
}

.apply-button {
  display: block;
  width: 100%;
  padding: 10px 20px;
  background-color: #3498db;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  text-align: center;
  margin-top: 20px;
  font-size: 16px;
}

.apply-button:hover {
  background-color: #2980b9;
}

.confirmation-message {
  margin-top: 20px;
  padding: 10px;
  background-color: #dff0d8;
  color: #3c763d;
  border: 1px solid #d6e9c6;
  border-radius: 5px;
  text-align: center;
}
</style>
