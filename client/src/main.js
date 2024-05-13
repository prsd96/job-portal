import { createApp } from 'vue';
import App from './App.vue';
import router from './router'; // Corrected import path

createApp(App)
  .use(router) // Use Vue Router
  .mount('#app');