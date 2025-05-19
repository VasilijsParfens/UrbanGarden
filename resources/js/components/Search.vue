<template>
    <div class="search-bar">
        <input
            type="text"
            v-model="searchQuery"
            @input="fetchUsers"
            placeholder="Search for plants..."
        />
        <button><i class="fas fa-search"></i></button>

        <!-- Add transition wrapper around dropdown -->
        <transition name="dropdown-fade">
            <div v-if="users.length > 0" class="dropdown">
                <ul>
                    <li v-for="user in users" :key="user.id">
                        <a :href="`/profile/${user.id}`">{{ user.name }}</a>
                    </li>
                </ul>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    data() {
        return {
            searchQuery: "",
            users: [],
        };
    },
    methods: {
        async fetchUsers() {
            if (this.searchQuery.length > 2) {
                try {
                    const response = await this.$axios.get("/search/users", {
                        params: { query: this.searchQuery },
                    });
                    this.users = response.data;
                } catch (error) {
                    console.error(error);
                }
            } else {
                this.users = [];
            }
        }
    },
};
</script>

<style scoped>
/* General Reset */
body {
    margin: 0;
    font-family: "Nunito", sans-serif;
    background-color: #f4f8f4;
}

/* Search Bar Styles */
.search-bar {
    position: relative;
    margin: 20px auto;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
}

.search-bar input {
    width: 60%;
    max-width: 600px;
    padding: 15px;
    font-size: 1.2rem;
    border: 2px solid #66bb6a;
    border-radius: 50px 0 0 50px;
    outline: none;
    transition: all 0.3s ease;
}

/* Change placeholder font */
.search-bar input::placeholder {
    font-family: "DM Sans", sans-serif;
    font-size: 1rem; /* Adjust the size as needed */
    color: #aaa; /* Adjust the color */
    font-style: italic; /* Optional */
}

.search-bar input:focus {
    border-color: #388e3c;
    box-shadow: 0 0 5px rgba(56, 142, 60, 0.6);
}

.search-bar button {
    padding: 15px 20px;
    font-size: 1.2rem;
    background-color: #66bb6a;
    color: white;
    border: 2px solid #66bb6a;
    border-radius: 0 50px 50px 0;
    cursor: pointer;
    transition: background-color 0.3s;
}

.search-bar button:hover {
    background-color: #388e3c;
}

/* Dropdown Styles */
.dropdown {
    position: absolute; /* Absolute positioning to place it directly below the input field */
    margin-top: 10px;
    top: 100%; /* This positions the dropdown below the search bar */
    margin-left: 0%;
    width: 100%; /* Make dropdown the same width as the search bar */
    max-width: 600px; /* Optional: Keep the dropdown width within a limit */
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 10;
    max-height: 300px;
    overflow-y: auto;
}

/* Transition Effects for the Dropdown */
.dropdown-fade-enter-active,
.dropdown-fade-leave-active {
    transition: opacity 0.3s, transform 0.3s ease;
}

.dropdown-fade-enter,
.dropdown-fade-leave-to /* .dropdown-fade-leave-active in <2.1.8 */ {
    opacity: 0;
    transform: translateY(-20px); /* Slide the dropdown up and fade out */
}

.dropdown-fade-enter-to {
    opacity: 1;
    transform: translateY(0); /* Slide it to its position */
}

.dropdown ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.dropdown li {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.dropdown li:last-child {
    border-bottom: none;
}

.dropdown a {
    text-decoration: none;
    color: #333;
    display: block;
    transition: background-color 0.3s;
}

.dropdown a:hover {
    background-color: #f1f1f1;
}
</style>
