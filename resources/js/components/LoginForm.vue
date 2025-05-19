<template>
    <div class="container">
        <div class="login-box">
            <h1>Welcome Back!</h1>
            <p>Log in to access your garden</p>
            <form @submit.prevent="login">
                <div class="input-field">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        v-model="email"
                        id="email"
                        placeholder="Enter your email"
                        required
                    />
                </div>
                <div class="input-field">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        v-model="password"
                        id="password"
                        placeholder="Enter your password"
                        required
                    />
                </div>
                <button type="submit" class="login-button">Log In</button>
                <div v-if="errorMessage" class="error-message">{{ errorMessage }}</div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
      errorMessage: '',
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post('/login', {
          email: this.email,
          password: this.password,
        });

        // Check if the response indicates success (status code or specific response key)
        if (response.status === 200) {
          // Redirect on successful login
          window.location.href = '/';
        }
      } catch (error) {
        // Handle validation or server errors
        if (error.response && error.response.status === 422) {
          this.errorMessage = error.response.data.message || 'Invalid email or password.';
        } else if (error.response && error.response.status === 429) {
          this.errorMessage = 'Too many login attempts. Please try again later.';
        } else {
          this.errorMessage = 'An error occurred. Please try again.';
        }
      }
    },
  },
};
</script>


<style scoped>
/* Add any relevant styles for the login form */
.error-message {
  color: red;
  font-size: 14px;
}
</style>
