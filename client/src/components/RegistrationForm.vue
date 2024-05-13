<template>
  <form @submit.prevent="register">
    <input type="text" v-model="name" placeholder="Name" required>
    <input type="email" v-model="email" placeholder="Email" required>
    <input type="password" v-model="password" placeholder="Password" required>
    <button type="submit">Register</button>
  </form>
</template>

<script>
import axios from 'axios';
import API_BASE_URL from '@/config.js';

export default {
  data() {
    return {
      name: '',
      email: '',
      password: ''
    };
  },
  methods: {
    register() {
      axios.post(`${API_BASE_URL}/register`, {
        name: this.name,
        email: this.email,
        password: this.password
      })
      .then(response => {
        // Handle successful registration
        const token = response.data.token;
        localStorage.setItem('token', token); // Save token to localStorage
        // Redirect to the job listing page
        this.$router.push('/jobs');
      })
      .catch(error => {
        // Handle registration error
        console.error('Registration failed:', error);
      });
    }
  }
}
</script>

<style scoped>
/* Component styles */
</style>
