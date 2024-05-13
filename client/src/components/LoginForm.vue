<!-- Login.vue -->
<template>
  <form @submit.prevent="login">
    <input type="email" v-model="email" placeholder="Email" required>
    <input type="password" v-model="password" placeholder="Password" required>
    <button type="submit">Login</button>
  </form>
</template>

<script>
import axios from 'axios';
import API_BASE_URL from '@/config.js';

export default {
  data() {
    return {
      email: '',
      password: ''
    };
  },
  methods: {
    login() {
      axios.post(`${API_BASE_URL}/login`, {
        email: this.email,
        password: this.password
      })
      .then(response => {
        // Handle successful login
        const token = response.data.token;
        localStorage.setItem('token', token); // Save token to localStorage
        // Redirect to the job listing page
        this.$router.push('/jobs');
      })
      .catch(error => {
        // Handle login error
        console.error('Login failed:', error);
      });
    }
  }
}
</script>

<style scoped>
/* Component styles */
</style>
