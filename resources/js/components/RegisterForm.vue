<template>
    <div class="container">
        <div class="register-box">
            <h1>Join the Community!</h1>
            <p>Create an account and start growing</p>
            <form @submit.prevent="submitForm">
                <!-- Name Field -->
                <div class="input-field">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        id="name"
                        v-model="form.name"
                        placeholder="Enter your name"
                        required
                    />
                    <!-- Display name validation error -->
                    <span v-if="errors.name" class="error-message">{{ errors.name[0] }}</span>
                </div>

                <!-- Email Field -->
                <div class="input-field">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        v-model="form.email"
                        placeholder="Enter your email"
                        required
                    />
                    <!-- Display email validation error -->
                    <span v-if="errors.email" class="error-message">{{ errors.email[0] }}</span>
                </div>

                <!-- Password Field -->
                <div class="input-field">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        v-model="form.password"
                        placeholder="Enter your password"
                        required
                    />
                    <!-- Display password validation error -->
                    <span v-if="errors.password" class="error-message">{{ errors.password[0] }}</span>
                </div>

                <!-- Confirm Password Field -->
                <div class="input-field">
                    <label for="password-confirm">Confirm Password</label>
                    <input
                        type="password"
                        id="password-confirm"
                        v-model="form.password_confirmation"
                        placeholder="Confirm your password"
                        required
                    />
                    <!-- Display confirm password validation error -->
                    <span v-if="errors.password_confirmation" class="error-message">{{ errors.password_confirmation[0] }}</span>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="register-button">Register</button>

                <!-- Display general error message -->
                <span v-if="generalError" class="error-message">{{ generalError }}</span>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            form: {
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
            },
            errors: {},  // Store validation errors
            generalError: "", // Store general error (e.g., server or unexpected errors)
        };
    },
    methods: {
        async submitForm() {
            try {
                // Get CSRF token from meta tag (or set it if missing)
                const csrfToken = document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content");

                // Send the form data with CSRF token
                const response = await axios.post("/register", this.form, {
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                });

                console.log("Registration successful:", response.data);

                // Only redirect if registration is successful
                if (response.data && response.data.message === "Registration successful!") {
                    window.location.href = "/"; // Redirect to the home page or wherever you'd like
                }
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    // Handle validation errors from Laravel
                    console.error("Registration Error:", error.response.data.errors);
                    this.errors = error.response.data.errors; // Set errors
                    this.generalError = ""; // Clear general errors if validation fails
                } else {
                    // Handle any unexpected errors
                    console.error("Error:", error);
                    this.generalError = "There was an error during registration."; // Display a general error
                    this.errors = {}; // Clear any validation errors
                }
            }
        },
    },
};
</script>

<style scoped>
.error-message {
    color: red;
    font-size: 0.875em;
    margin-top: 5px;
}
</style>
