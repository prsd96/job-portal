<template>
  <div class="jobs-container">
    <h2>Jobs Listing</h2>

    <!-- Link to job posting form -->
    <router-link class="post-job-link" to="/create-job">Post a Job</router-link>
    
    <!-- Filter form -->
    <form @submit.prevent="applyFilters" class="filter-form">
      <label class="hidden">
        Category:
        <input type="text" v-model="filters.category">
      </label>
      <label>
        Location:
        <input type="text" v-model="filters.location">
      </label>
      <label class="hidden">
        Keywords:
        <input type="text" v-model="filters.keywords">
      </label>
      <button type="submit">Apply Filters</button>
    </form>

    <!-- Display job listings in a table -->
    <table class="job-table">
      <thead>
        <tr>
          <th>Job Title</th>
          <th>Company</th>
          <th>Location</th>
          <th>Created At</th>
          <th>Actions</th> <!-- New column for actions -->
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
            <button @click="viewJobDetails(job)" class="view-details-button">View Details</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination controls -->
    <div class="pagination">
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
.jobs-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

h2 {
  text-align: center;
  color: #2c3e50;
}

.post-job-link {
  display: block;
  text-align: center;
  margin-bottom: 20px;
  color: #3498db;
  text-decoration: none;
  font-weight: bold;
}

.filter-form {
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
}

.filter-form label {
  margin-right: 10px;
}

.hidden {
  display: none;
}

.filter-form input {
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.filter-form button {
  padding: 8px 16px;
  background-color: #3498db;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.filter-form button:hover {
  background-color: #2980b9;
}

.job-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

.job-table th,
.job-table td {
  padding: 12px;
  border: 1px solid #ddd;
  text-align: center;
}

.job-table th {
  background-color: #f2f2f2;
  font-weight: bold;
}

.view-details-button {
  padding: 8px 16px;
  background-color: #3498db;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.view-details-button:hover {
  background-color: #2980b9;
}

.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
}

.pagination button {
  padding: 8px 16px;
  margin: 0 10px;
  background-color: #3498db;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.pagination button:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}
</style>
