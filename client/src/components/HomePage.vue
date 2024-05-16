<template>
  <div class="home-container">
    <header class="hero-section">
      <h1>Welcome to Job Portal</h1>
      <p>Your one-stop solution for finding the perfect job and the best talent.</p>
      <div class="cta-buttons">
        <router-link to="/jobs" class="btn primary-btn">View Jobs</router-link>
        <router-link to="/login" class="btn secondary-btn">Login</router-link>
        <router-link to="/register" class="btn secondary-btn">Register</router-link>
      </div>
    </header>
    <section class="features-section">
      <h2>Why Choose Us?</h2>
      <div class="features">
        <div class="feature">
          <h3>Wide Range of Jobs</h3>
          <p>Find job opportunities from various industries and companies.</p>
        </div>
        <div class="feature">
          <h3>Easy Application Process</h3>
          <p>Apply for jobs with just a few clicks using our user-friendly interface.</p>
        </div>
        <div class="feature">
          <h3>Personalized Recommendations</h3>
          <p>Get job suggestions tailored to your skills and preferences.</p>
        </div>
      </div>
    </section>
    <section class="testimonials-section">
      <h2>What Our Users Say</h2>
      <div class="testimonials">
        <div class="testimonial">
          <p>"This platform helped me find my dream job in no time!"</p>
          <p><strong>- Alex J.</strong></p>
        </div>
        <div class="testimonial">
          <p>"A seamless experience from start to finish. Highly recommend!"</p>
          <p><strong>- Taylor S.</strong></p>
        </div>
        <div class="testimonial">
          <p>"Great variety of job listings and very easy to use."</p>
          <p><strong>- Jamie L.</strong></p>
        </div>
      </div>
    </section>
    <footer class="footer">
      <p>&copy; 2024 Job Portal. All rights reserved.</p>
    </footer>
  </div>
</template>

<script>
export default {
  // Component code
}
</script>

<style scoped>
.home-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  box-sizing: border-box;
}

.hero-section {
  text-align: center;
  background-color: #2c3e50;
  color: #fff;
  padding: 50px 20px;
  border-radius: 10px;
  margin-bottom: 30px;
}

.hero-section h1 {
  font-size: 3em;
  margin-bottom: 20px;
}

.hero-section p {
  font-size: 1.5em;
  margin-bottom: 30px;
}

.cta-buttons {
  display: flex;
  justify-content: center;
  gap: 10px;
}

.btn {
  padding: 15px 30px;
  border: none;
  border-radius: 5px;
  text-decoration: none;
  font-size: 1.2em;
  cursor: pointer;
}

.primary-btn {
  background-color: #27ae60;
}

.secondary-btn {
  background-color: #c0392b;
}

.features-section, .testimonials-section {
  margin-bottom: 30px;
}

h2{
  text-align: center;
  font-size: 2.5em;
  margin-bottom: 30px;
}

.features, .testimonials {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: space-around;
}

.feature, .testimonial {
  flex: 1;
  min-width: 300px;
  padding: 30px;
  background: #ecf0f1;
  border-radius: 10px;
  text-align: center;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.feature h3, .testimonial p {
  font-size: 1.8em;
  margin-bottom: 20px;
}

.footer {
  text-align: center;
  padding: 20px 0;
  background: #34495e;
  border-top: 2px solid #2c3e50;
}

.footer p {
  color: #fff;
  font-size: 1.2em;
}
</style>
