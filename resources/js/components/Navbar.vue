<template>
    <nav class="navbar">
        <div class="navbar-brand">
            <i class="fas fa-seedling"></i> UrbanGarden
        </div>
        <div class="menu-toggle" @click="toggleMenu">
            <i class="fas fa-bars"></i>
        </div>
        <div :class="['navbar-menu', { active: isMenuActive }]">
            <router-link to="/admin" class="navbar-link">
                <i class="fas fa-tools"></i> Admin Panel
            </router-link>
            <router-link to="/profile" class="navbar-link">
                <i class="fas fa-user"></i> Profile
            </router-link>
            <router-link to="/register" class="navbar-link">
                <i class="fas fa-user-plus"></i> Register
            </router-link>
            <router-link to="/login" class="navbar-link">
                <i class="fas fa-sign-in-alt"></i> Login
            </router-link>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            isMenuActive: false,
        };
    },
    methods: {
        toggleMenu() {
            this.isMenuActive = !this.isMenuActive;
        },
    },
};
</script>

<style>
/* Root Variables */
:root {
    --primary-color: #2D6A4F; /* Green theme */
    --secondary-color: #388E3C; /* Darker green */
    --tertiary-color: #1B5E20; /* Even darker green */
    --text-color: #fff; /* White text */
    --bg-light: rgba(255, 255, 255, 0.9); /* Light background */
    --font-primary: "DM Sans", sans-serif;
    --border-radius: 6px;
    --border-radius-large: 10px;
    --box-shadow-light: 0 4px 15px rgba(0, 0, 0, 0.1);
    --box-shadow-medium: 0 10px 30px rgba(0, 0, 0, 0.1);
    --transition-speed: 0.3s;
}

/* Navbar Styles */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: var(--primary-color);
    padding: 10px 20px;
    box-shadow: var(--box-shadow-medium);
    position: relative;
    z-index: 100;
}

/* Logo with Subtle Animation */
.navbar-brand {
    font-size: 1.8rem;
    font-weight: bold;
    color: var(--text-color);
    display: flex;
    align-items: center;
    gap: 10px;
    animation: bounce 4s infinite ease-in-out;
}

.navbar-brand i {
    color: #ffd700; /* Golden leaf icon */
}

/* Subtle Bouncing Animation */
@keyframes bounce {
    0%,
    100% {
        transform: translateY(0);
    }
    25% {
        transform: translateY(-2px);
    }
    50% {
        transform: translateY(0);
    }
    75% {
        transform: translateY(-2px);
    }
}

/* Navbar Menu Styles */
.navbar-menu {
    display: flex;
    gap: 1.25rem;
    align-items: center;
}

.navbar-link {
    color: var(--text-color);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1rem;
    padding: 0.5rem 0.75rem;
    border-radius: var(--border-radius);
    transition: background-color var(--transition-speed), transform 0.2s;
}

.navbar-link:hover {
    background-color: var(--secondary-color);
    transform: translateY(-0.125rem);
}

.menu-toggle {
    display: none;
    font-size: 1.8rem;
    color: var(--text-color);
    cursor: pointer;
}

/* Dropdown Menu Styles for Smaller Screens */
@media (max-width: 600px) {
    .menu-toggle {
        display: block;
    }

    .navbar-menu {
        display: none;
        flex-direction: column;
        position: absolute;
        top: 60px;
        right: 20px;
        background-color: var(--primary-color);
        border-radius: var(--border-radius-large);
        box-shadow: var(--box-shadow-medium);
        overflow: hidden;
        transition: all var(--transition-speed) ease;
    }

    .navbar-menu.active {
        display: flex;
    }

    .navbar-link {
        padding: 12px 20px;
        border-bottom: 1px solid var(--secondary-color);
    }

    .navbar-link:last-child {
        border-bottom: none;
    }
}
</style>
