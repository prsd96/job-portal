<template>
  <div>
    <h2>Jobs Listing</h2>

    <!-- Link to job posting form -->
    <router-link to="/create-job">Post a Job</router-link>
    
    <!-- Filter form -->
    <form @submit.prevent="applyFilters">
      <label style="display:none">
        Category:
        <input type="text" v-model="filters.category">
      </label>
      <label>
        Location:
        <input type="text" v-model="filters.location">
      </label>
      <label style="display:none">
        Keywords:
        <input type="text" v-model="filters.keywords">
      </label>
      <button type="submit">Apply Filters</button>
    </form>

    <!-- Display job listings in a table -->
    <table>
      <thead>
        <tr>
          <th>Job Title</th>
          <th>Company</th>
          <th>Location</th>
          <th>Created At</th>
          <th>Actions</th> <!-- New column for actions -->
          <!-- Add more table headers as needed -->
        </tr>
      </thead>
      <tbody>
        <tr v-for="job in paginatedJobs" :key="job.id">
          <td>{{ job.job_title }}</td>
          <td>{{ job.company_name }}</td>
          <td>{{ job.location }}</td>
          <td>{{ formatDate(job.created_at) }}</td>
          <td>
            <!-- Button to view job details -->
            <button @click="viewJobDetails(job)">View Details</button>
          </td>
          <!-- Add more table cells as needed -->
        </tr>
      </tbody>
    </table>

    <!-- Pagination controls -->
    <div>
      <button @click="prevPage" :disabled="currentPage === 1">Previous</button>
      <span>Page {{ currentPage }} of {{ totalPages }}</span>
      <button @click="nextPage" :disabled="currentPage === totalPages">Next</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import API_BASE_URL from '@/config.js';

export default {
  data() {
    return {
      jobs: [],
      currentPage: 1,
      perPage: 10,
      filters: {
        category: '',
        location: '',
        keywords: ''
      }
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.filteredJobs.length / this.perPage);
    },
    paginatedJobs() {
      const startIndex = (this.currentPage - 1) * this.perPage;
      const endIndex = startIndex + this.perPage;
      return this.filteredJobs.slice(startIndex, endIndex);
    },
    filteredJobs() {
      let filteredJobs = this.jobs;
      if (this.filters.category) {
        filteredJobs = filteredJobs.filter(job => job.category.includes(this.filters.category));
      }
      if (this.filters.location) {
        filteredJobs = filteredJobs.filter(job => job.location.includes(this.filters.location));
      }
      if (this.filters.keywords) {
        filteredJobs = filteredJobs.filter(job => job.title.includes(this.filters.keywords) || job.description.includes(this.filters.keywords));
      }
      return filteredJobs;
    }
  },
  mounted() {
    this.fetchJobs();
  },
  methods: {
    viewJobDetails(job) {
      // Redirect to a separate route or component for job details
      // You can pass the job ID as a route parameter or as props to the job details component
      this.$router.push({ name: 'JobDetails', params: { jobId: job.id } });
    },
    fetchJobs() {
      const token = localStorage.getItem('token');
      axios.get(`${API_BASE_URL}/jobs`, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      })
      .then(response => {
        this.jobs = response.data;
      })
      .catch(error => {
        console.error('Error fetching jobs:', error);
      });
    },
    formatDate(dateString) {
      const date = new Date(dateString);
      const day = date.getDate();
      const month = date.getMonth() + 1;
      const year = date.getFullYear();
      return `${day}-${month}-${year}`;
    },
    applyFilters() {
      // Reset current page to 1 when applying filters
      this.currentPage = 1;
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    }
  }
}
</script>

<style scoped>
/* Component styles */
table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
}
</style>
