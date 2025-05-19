<nav class="navbar">
    <div class="navbar-brand">
        <a href="/" style="text-decoration: none; color: inherit;">
            <i class="fas fa-leaf"></i> UrbanGarden
        </a>
    </div>

    <!-- Centered Search Bar -->
    <div class="search-container-wrapper">
        <form action="{{ route('search') }}" method="GET" class="search-form">
            <input type="text" name="query" class="search-input" placeholder="Search for plants, tips, questions..."
                required>
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <div class="menu-toggle" id="menuToggle" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
    </div>

    <div class="navbar-menu" id="navbarMenu">
        @guest
            <a href="/register" class="navbar-link">
                <i class="fas fa-user-plus"></i> Register
            </a>
            <a href="/login" class="navbar-link">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
        @endguest

        @auth
            <a href="{{ route('profile.show', auth()->user()->id) }}" class="navbar-link">
                <i class="fas fa-user"></i> Profile
            </a>

            @if (auth()->user()->is_admin == 1)
                <a href="/admin/plants" class="navbar-link">
                    <i class="fas fa-tools"></i> Admin Panel
                </a>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="navbar-link" style="display: inline;">
                @csrf
                <button type="submit"
                    style="background: none; border: none; color: var(--primary-color); cursor: pointer;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        @endauth
    </div>
</nav>




<style>
    .navbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--white);
    padding: 12px 24px;
    box-shadow: var(--box-shadow-medium);
    position: sticky;
    top: 0;
    width: 100%;
    z-index: 1000;
    box-sizing: border-box;
    flex-wrap: wrap;
}

.navbar-brand a {
    font-size: 1.25rem;
    font-weight: bold;
    white-space: nowrap;
}

.search-container-wrapper {
    flex: 1;
    display: flex;
    justify-content: center;
    margin: 0.5rem 0;
}

.search-form {
    display: flex;
    align-items: center;
    background-color: #f0f4f8;
    border-radius: 9999px;
    padding: 0.25rem 0.5rem;
    border: 1px solid var(--primary-color);
    width: 100%;
    max-width: 600px;
    transition: box-shadow 0.2s ease;
}

.search-form:focus-within {
    box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.3);
}

.search-input {
    border: none;
    outline: none;
    background: transparent;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    flex: 1;
    min-width: 0;
}

.search-input::placeholder {
    color: #888;
}

.search-btn, .navbar-link button {
    background-color: var(--primary-color);
    border: none;
    padding: 0.5rem 0.75rem;
    border-radius: 9999px;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background-color 0.2s ease;
    font-size: 1rem; /* Ensure consistent font size */
}

.search-btn:hover, .navbar-link button:hover {
    background-color: #1a73e8cc;
}

.menu-toggle {
    display: none;
    cursor: pointer;
    font-size: 1.25rem;
}

.navbar-menu {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.navbar-link, .navbar-link button {
    text-decoration: none;
    color: var(--primary-color);
    display: flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.5rem 0.75rem; /* Ensure consistent padding */
    white-space: nowrap;
    border-radius: 9999px; /* Ensure consistent border-radius */
    transition: background-color 0.2s ease;
    font-size: 1rem; /* Ensure consistent font size */
}

.navbar-link:hover, .navbar-link button:hover {
    background-color: #f0f4f8; /* Consistent hover background */
}

/* Responsive styles */
@media (max-width: 768px) {
    .menu-toggle {
        display: block;
    }

    .navbar {
        flex-direction: column;
        align-items: flex-start;
    }

    .search-container-wrapper {
        order: 2;
        width: 100%;
    }

    .navbar-menu {
        display: none;
        flex-direction: column;
        width: 100%;
        order: 3;
    }

    .navbar-menu.active {
        display: flex;
    }

    .navbar-link, .navbar-link button {
        width: 100%;
        padding: 0.75rem;
        border-top: 1px solid #eee;
    }
}

</style>
