<template>
    <div class="tabs-container">
        <div
            v-for="(tab, index) in tabs"
            :key="index"
            class="tab"
            :class="{ active: activeTab === tab }"
            @click="selectTab(tab)"
        >
            {{ tab }}
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tabs: ["Home", "Plants", "Tips", "Questions", "Tips", "Showcase", "Identification"], // Added "Home"
            activeTab: "Home", // Default active tab set to "Home"
        };
    },
    methods: {
        selectTab(tab) {
            this.activeTab = tab;
        },
    },
};
</script>

<style scoped>
.tabs-container {
    display: flex;
    justify-content: center;
    gap: 1.5rem; /* Gap between tabs */
    margin: 2rem 0;
    flex-wrap: wrap; /* Allow wrapping on small screens */
}

.tab {
    position: relative;
    font-size: 1.2rem;
    font-weight: 500;
    color: #555;
    cursor: pointer;
    padding: 0.5rem 1rem;
    transition: color 0.3s ease;
}

.tab:hover {
    color: #333;
}

.tab::before {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 2px;
    background-color: #333;
    transform: scaleX(0);
    transition: transform 0.3s ease;
    transform-origin: center;
}

.tab:hover::before {
    transform: scaleX(1);
}

.tab.active {
    color: #222;
}

.tab.active::before {
    transform: scaleX(1);
}

/* Responsive styles */
@media (max-width: 768px) {
    .tabs-container {
        gap: 1rem; /* Reduce gap on small screens */
        flex-direction: column; /* Stack tabs vertically */
        align-items: center; /* Center-align stacked tabs */
    }

    .tab {
        font-size: 1rem; /* Slightly smaller font size */
        padding: 0.5rem; /* Adjust padding for smaller screens */
    }
}
</style>
