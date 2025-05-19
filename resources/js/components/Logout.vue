<template>
    <div class="logout-container">
        <button @click="logout" class="logout-button">Log Out</button>
    </div>
</template>

<script>
import axios from "axios";

export default {
    methods: {
        async logout() {
            try {
                const response = await axios.post("/logout"); // POST request to /logout

                if (response.data.success) {
                    window.location.href = "/"; // Redirect after logout
                }
            } catch (error) {
                console.error("Logout failed", error);
            }
        },
    },
};
</script>

<style scoped>
.logout-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.logout-button {
    background-color: #f44336;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border: none;
    border-radius: 5px;
}

.logout-button:hover {
    background-color: #d32f2f;
}
</style>
