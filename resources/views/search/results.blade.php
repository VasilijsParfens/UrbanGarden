<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Search Results - UrbanGarden</title>
    <meta name="description"
        content="Search UrbanGarden for plants, users, and posts. Discover botanical knowledge and connect with nature lovers.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" defer>
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

        .container {
            padding: var(--spacing-large);
            max-width: 1200px;
            margin: auto;
        }

        h1 {
            font-size: var(--font-size-xlarge);
            color: var(--primary-color);
            margin-bottom: var(--spacing-large);
        }

        section {
            margin-bottom: var(--spacing-large);
            padding-top: var(--spacing-large);
            border-top: 1px solid var(--border-color-light);
        }

        section h2 {
            font-size: var(--font-size-large);
            color: var(--primary-color);
            margin-bottom: var(--spacing-medium);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: clamp(12px, 3vw, 44px);
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

        .card p {
            font-size: var(--font-size-small);
            color: var(--secondary-color);
        }

        .no-results {
            color: var(--secondary-color);
            font-style: italic;
        }

        @media (max-width: 768px) {
            .grid-container {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        @media (max-width: 600px) {
            .grid-container {
                grid-template-columns: repeat(2, 1fr);
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
    <div class="container">
        <h1>Search Results for "{{ e(request('query')) }}"</h1>

        <!-- Plants -->
        <section>
            <h2>🌿 Plants ({{ $plants->count() }})</h2>
            @if ($plants->count())
                <div class="grid-container">
                    @foreach ($plants as $plant)
                        <a href="{{ route('plants.show', $plant->id) }}" class="card"
                            aria-label="View plant {{ $plant->name }}">
                            <div class="card-content">
                                <img src="{{ asset('storage/images/plants/' . $plant->image) }}"
                                    alt="Photo of plant: {{ $plant->name }}" loading="lazy">
                                <h3>{{ $plant->name }}</h3>
                                <p><em>{{ $plant->scientific_name }}</em></p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="no-results">No matching plants found. Try a different keyword or browse <a
                        href="{{ route('plants.index') }}">all plants</a>.</p>
            @endif
        </section>


        <!-- Users -->
        <section>
            <h2>👤 Users ({{ $users->count() }})</h2>
            @if ($users->count())
                <div class="grid-container">
                    @foreach ($users as $user)
                        <a href="{{ route('profile.show', $user->id) }}" class="card"
                            aria-label="View profile of {{ $user->name }}">
                            <div class="card-content">
                                <img src="{{ asset('storage/images/assigned_profile_pictures/' . $user->profile_picture) }}"
                                    alt="Profile picture of {{ $user->name }}" loading="lazy">
                                <h3>{{ $user->name }}</h3>
                                <p>{{ $user->email }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="no-results">No matching users found.</p>
            @endif

        </section>

        <!-- Posts -->
        <section>
            <h2>📝 Posts ({{ $posts->count() }})</h2>
            @if ($posts->count())
                <div class="grid-container">
                    @foreach ($posts as $post)
                        <a href="{{ route('posts.show', $post->id) }}" class="card"
                            aria-label="Read post titled {{ $post->title }}">
                            <div class="card-content">
                                @if ($post->image)
                                    <img src="{{ asset('storage/images/posts/' . $post->image) }}"
                                        alt="Image for post: {{ $post->title }}" loading="lazy">
                                @endif
                                <h3>{{ $post->title }}</h3>
                                <p>{{ Str::limit($post->content, 100) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="no-results">No matching posts found.</p>
            @endif
        </section>
    </div>
</body>

</html>
