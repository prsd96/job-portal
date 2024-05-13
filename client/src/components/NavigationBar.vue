<template>
  <nav>
    <ul>
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
/* Component styles */
</style>
