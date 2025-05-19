<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Discover featured plants, gardening tips, community questions, showcases, and plant identifications on our Modern UrbanGarden page.">
    <title>Modern UrbanGarden</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: var(--font-primary);
            margin: 0;
            padding: 0;
            background: var(--gradient-bg);
            color: var(--dark-text);
        }

        body.loaded {
            visibility: visible;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .homepage-container {
            padding: var(--spacing-large);
            max-width: 1200px;
            margin: auto;
        }

        .homepage-section {
            margin-bottom: var(--spacing-large);
        }

        .homepage-section h2 {
            font-size: var(--font-size-large);
            color: var(--primary-color);
            margin-bottom: var(--spacing-medium);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-medium);
        }

        .view-all-link {
            font-size: var(--font-size-medium);
            font-weight: var(--font-weight-regular);
            color: var(--primary-color);
            text-decoration: none;
            padding: var(--padding-medium);
            border-radius: var(--border-radius);
            transition: background-color var(--transition-speed) ease, transform var(--transition-speed) ease;
        }

        .view-all-link:hover {
            background-color: rgba(26, 115, 232, 0.1);
            transform: translateY(-2px);
        }

        .view-all-link:focus-visible {
            outline: 2px solid var(--primary-color);
            outline-offset: 3px;
        }

        .view-all-link:active {
            background-color: rgba(26, 115, 232, 0.2);
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: clamp(12px, 3vw, 24px);
        }

        .card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: var(--bg-light);
            border-radius: var(--border-radius-large);
            box-shadow: var(--box-shadow-light);
            padding: var(--padding-large);
            text-align: center;
            transition: transform var(--transition-speed) ease, box-shadow var(--transition-speed) ease, opacity var(--transition-speed) ease;
            cursor: pointer;
            overflow: hidden;
            height: 100%;
        }

        .card-content {
            flex-grow: 1;
        }

        .card:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: var(--box-shadow-medium);
        }

        .card h3 {
            font-size: var(--font-size-medium);
            margin: var(--spacing-small) 0;
            color: var(--primary-color);
        }

        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: var(--border-radius);
            transition: transform var(--transition-speed) ease;
        }

        .card:hover img {
            transform: scale(1.05);
        }

        .tip-card a {
            text-decoration: none;
            color: inherit;
        }

        .icons {
            display: flex;
            justify-content: center;
            gap: var(--gap-medium);
            font-size: var(--font-size-small);
            color: var(--secondary-color);
        }

        .author,
        .location,
        .date {
            font-size: var(--font-size-xsmall);
            color: gray;
            display: block;
            margin-top: var(--spacing-small);
        }

        .date i {
            margin-right: var(--spacing-xsmall);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: var(--gap-medium);
            margin-top: auto;
        }

        .user-info .profile-pic {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #ddd;
        }

        .user-link {
            display: flex;
            align-items: center;
            gap: var(--gap-medium);
            text-decoration: none;
            color: inherit;
        }

        .user-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .grid-container {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        @media (max-width: 480px) {
            .grid-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <x-navbar />

    <div class="homepage-container">

        <!-- PLANTS SECTION -->
        <section class="homepage-section" aria-labelledby="plants-section">
            <div class="section-header">
                <h2 id="plants-section">🌿 Featured Plants</h2>
                <a href="{{ route('plants.index') }}" class="view-all-link">View All</a>
            </div>
            <div class="grid-container">
                @foreach ($plants as $plant)
                    <a href="{{ route('plants.show', ['plant' => $plant->id]) }}" class="card plant-card">
                        <div class="card-content">
                            <img src="{{ asset('storage/images/plants/' . ($plant->image && file_exists(storage_path('app/public/images/plants/' . $plant->image)) ? $plant->image : 'no_image.jpg')) }}"
                                alt="{{ $plant->name }}" loading="lazy">
                            <h3>{{ $plant->name }}</h3>
                            <span class="date"><i class="fas fa-calendar-alt"></i>
                                {{ $plant->created_at->format('F d, Y') }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- GARDENING TIPS SECTION -->
        <section class="homepage-section" aria-labelledby="tips-section">
            <div class="section-header">
                <h2 id="tips-section">💡 Gardening Tips</h2>
                <a href="{{ route('posts.lists.show', ['type' => 'tip']) }}" class="view-all-link">View All</a>
            </div>
            <div class="grid-container">
                @foreach ($tips as $tip)
                    <div class="card tip-card">
                        <div class="card-content">
                            <a href="{{ route('posts.show', ['id' => $tip->id]) }}">
                                <h3>{{ $tip->title }}</h3>
                                <p>{{ Str::limit($tip->content, 80) }}</p>
                                <span class="date">
                                    <i class="fas fa-calendar-alt"></i> {{ $tip->created_at->format('F d, Y') }}
                                </span>
                            </a>
                        </div>
                        <div class="user-info">
                            <a href="{{ route('profile.show', ['user' => $tip->user->id]) }}" class="user-link">
                                <img class="profile-pic"
                                    src="{{ asset('storage/images/assigned_profile_pictures/' . ($tip->user->profile_picture ?? 'no_avatar.png')) }}"
                                    alt="User Avatar">
                                <span class="author">By {{ $tip->user->name }}</span>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>

        <!-- SHOWCASES SECTION -->
        <section class="homepage-section" aria-labelledby="showcases-section">
            <div class="section-header">
                <h2 id="showcases-section">🏆 Community Showcases</h2>
                <a href="{{ route('posts.lists.show', ['type' => 'showcase']) }}" class="view-all-link">View All</a>
            </div>
            <div class="grid-container">
                @foreach ($showcases as $showcase)
                    <div class="card showcase-card">
                        <div class="card-content">
                            <a href="{{ route('posts.show', ['id' => $showcase->id]) }}">
                                <img src="{{ asset('storage/images/posts/' . ($showcase->image ?? 'placeholder.jpg')) }}"
                                    alt="{{ $showcase->title }}" loading="lazy">
                                <h3>{{ $showcase->title }}</h3>
                                <p>{{ Str::limit($showcase->content, 80) }}</p>
                                <span class="date"><i class="fas fa-calendar-alt"></i>
                                    {{ $showcase->created_at->format('F d, Y') }}</span>
                            </a>
                        </div>
                        <div class="user-info">
                            <a href="{{ route('profile.show', ['user' => $showcase->user->id]) }}" class="user-link">
                                <img class="profile-pic"
                                    src="{{ asset('storage/images/assigned_profile_pictures/' . ($showcase->user->profile_picture ?? 'no_avatar.png')) }}"
                                    alt="User Avatar">
                                <span class="author">By {{ $showcase->user->name }}</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- QUESTIONS SECTION -->
        <section class="homepage-section" aria-labelledby="questions-section">
            <div class="section-header">
                <h2 id="questions-section">❓ Community Questions</h2>
                <a href="{{ route('posts.lists.show', ['type' => 'question']) }}" class="view-all-link">View All</a>
            </div>
            <div class="grid-container">
                @foreach ($questions as $question)
                    <div class="card question-card">
                        <div class="card-content">
                            <a href="{{ route('posts.show', ['id' => $question->id]) }}">
                                <h3>{{ Str::limit($question->title, 60) }}</h3>
                                <p>{{ Str::limit($question->content, 80) }}</p>
                                <span class="date"><i class="fas fa-calendar-alt"></i>
                                    {{ $question->created_at->format('F d, Y') }}</span>
                            </a>
                        </div>
                        <div class="user-info">
                            <a href="{{ route('profile.show', ['user' => $question->user->id]) }}" class="user-link">
                                <img class="profile-pic"
                                    src="{{ asset('storage/images/assigned_profile_pictures/' . ($question->user->profile_picture ?? 'no_avatar.png')) }}"
                                    alt="User Avatar">
                                <span class="author">Asked by {{ $question->user->name }}</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- PLANT IDENTIFICATIONS SECTION -->
        <section class="homepage-section" aria-labelledby="identifications-section">
            <div class="section-header">
                <h2 id="identifications-section">🌱 Plant Identifications</h2>
                <a href="{{ route('posts.lists.show', ['type' => 'plant_identification']) }}"
                    class="view-all-link">View All</a>
            </div>
            <div class="grid-container">
                @foreach ($identifications as $identification)
                    <div class="card identification-card">
                        <div class="card-content">
                            <a href="{{ route('posts.show', ['id' => $identification->id]) }}">
                                <img src="{{ asset('storage/images/posts/' . ($identification->image ?? 'no_image.jpg')) }}" alt="Unknown Plant"
                                    loading="lazy">
                                <p>{{ Str::limit($identification->content, 80) }}</p>
                                <span class="date"><i class="fas fa-calendar-alt"></i>
                                    {{ $identification->created_at->format('F d, Y') }}</span>
                            </a>
                        </div>
                        <div class="user-info">
                            <a href="{{ route('profile.show', ['user' => $identification->user->id]) }}"
                                class="user-link">
                                <img class="profile-pic"
                                    src="{{ asset('storage/images/assigned_profile_pictures/' . ($identification->user->profile_picture ?? 'no_avatar.png')) }}"
                                    alt="User Avatar">
                                <span class="author">Identified by {{ $identification->user->name }}</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.body.classList.add("loaded");
    });
</script>

</html>
