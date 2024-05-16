<template>
  <nav class="navbar">
    <div class="navbar-brand">
      <router-link to="/">Job Portal</router-link>
    </div>
    <ul class="navbar-menu">
      <li><router-link to="/">Home</router-link></li>
      <template v-if="!isLoggedIn">
        <li><router-link to="/register">Register</router-link></li>
        <li><router-link to="/login">Login</router-link></li>
      </template>
      <template v-else>
        <li><button @click="logout">Logout</button></li>
      </template>
    </ul>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      isLoggedIn: false // Initially assume user is not logged in
    };
  },
  mounted() {
    // Check if user is logged in (e.g., by checking token in local storage)
    const token = localStorage.getItem('token');
    if (token) {
      this.isLoggedIn = true;
    }
  },
  methods: {
    logout() {
      // Perform logout logic (e.g., remove token from local storage)
      localStorage.removeItem('token');
      // Update isLoggedIn status
      this.isLoggedIn = false;
      // Redirect to home page
      this.$router.push('/');
    },
    loginSuccess() {
      // Update isLoggedIn status
      this.isLoggedIn = true;
      // Redirect to home page
      this.$router.push('/');
    }
  }
}
</script>

<style scoped>
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #2c3e50;
  padding: 1rem;
}

nav ul {
  list-style: none;
  display: flex;
  justify-content: space-between;
}

nav ul li {
  margin: 0 10px; /* Adjust margin as needed */
}

.navbar-brand {
  font-size: 1.5rem;
  font-weight: bold;
  color: #ecf0f1;
}

.navbar-brand a {
  color: #ecf0f1;
  text-decoration: none;
}

.navbar-menu {
  display: flex;
  align-items: center;
  list-style: none;
  margin: 0;
  padding: 0;
}

.navbar-menu li {
  margin-left: 1rem;
}

.navbar-menu a {
  color: #ecf0f1;
  text-decoration: none;
  padding: 0.5rem 1rem;
  border-radius: 5px;
  transition: background-color 0.3s;
}

.navbar-menu a:hover {
  background-color: #34495e;
}

.navbar-menu button {
  background: none;
  border: none;
  color: #ecf0f1;
  cursor: pointer;
  padding: 0.5rem 1rem;
  border-radius: 5px;
  transition: background-color 0.3s;
}

.navbar-menu button:hover {
  background-color: #34495e;
}
</style>
