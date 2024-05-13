// router.js
import { createRouter, createWebHistory } from 'vue-router';
import HomePage from './components/HomePage.vue';
import RegistrationForm from './components/RegistrationForm.vue'; // Import Register component
import LoginForm from './components/LoginForm.vue'; // Import Login component
import JobListing from './components/JobListing.vue'; // Import JobListing component
import JobPostingForm from './components/JobPostingForm.vue'; // Import JobListing component
import JobDetails from './components/JobDetails.vue'; // Import JobListing component

const routes = [
  { path: '/', component: HomePage },
  { path: '/register', component: RegistrationForm }, // Route for Register component
  { path: '/login', component: LoginForm }, // Route for Login component
  { path: '/jobs', component: JobListing }, // Route for JobListing component
  { path: '/create-job', component: JobPostingForm }, // Route for JobListing component
  { path: '/job-data/:jobId', name: 'JobDetails', component: JobDetails }, // Route for JobListing component
  // Define other routes here
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
