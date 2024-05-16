<template>
  <div class="auth-container">
    <form @submit.prevent="login" class="auth-form">
      <h2>Login</h2>
      <input type="email" v-model="email" placeholder="Email" required>
      <input type="password" v-model="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
  </div>
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
.auth-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f5f5f5;
  margin: 0; /* Ensure no margins */
  padding: 0; /* Ensure no paddings */
  overflow: hidden; /* Hide any overflow */
}

.auth-form {
  background: white;
  padding: 2rem;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px;
  text-align: center;
}

.auth-form h2 {
  margin-bottom: 1rem;
  font-size: 1.5rem;
  color: #333;
}

.auth-form input {
  width: 100%;
  padding: 0.75rem;
  margin-bottom: 1rem;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 1rem;
}

.auth-form button {
  width: 100%;
  padding: 0.75rem;
  background-color: #2c3e50;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 1rem;
  cursor: pointer;
  transition: background-color 0.3s;
}

.auth-form button:hover {
  background-color: #34495e;
}
</style>
