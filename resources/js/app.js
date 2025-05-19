import { createApp } from "vue";
import axios from "axios";
import RegisterForm from "./components/RegisterForm.vue";
import LoginForm from "./components/LoginForm.vue"; // Import the LoginForm component
import Logout from "./components/Logout.vue";
import Navbar from "./components/Navbar.vue";
import Search from './components/Search.vue';
import NavTabs from "./components/NavTabs.vue";

// Set up the CSRF token in the Axios default headers
axios.defaults.headers.common["X-CSRF-TOKEN"] = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");
// Optionally, set the base URL for your API (if needed)
axios.defaults.baseURL = "/"; // Adjust this to match your API URL if different

// Create the Vue app and register the components
const app = createApp({});
app.config.globalProperties.$axios = axios;
app.component("register-form", RegisterForm);
app.component("login-form", LoginForm); // Register the LoginForm component
app.component("logout-button", Logout); // Register the LoginForm component
app.component("navbar", Navbar);
app.component('search', Search);
app.component('nav-tabs', NavTabs);

// Mount the Vue app
app.mount("#app");
