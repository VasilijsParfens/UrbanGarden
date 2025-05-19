<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-primary);
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            width: 80%;
            max-width: 1300px;
            background: white;
            border-radius: var(--border-radius-large);
            box-shadow: var(--box-shadow-light);
            padding: 40px;
            text-align: center;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
        }

        .container:hover {
            transform: translateY(-10px);
        }

        .profile-header {
            margin-bottom: 50px;
            text-align: center;
            position: relative;
        }

        .profile-header img,
        .default-profile {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: var(--box-shadow-light);
            transition: transform 0.3s ease-in-out;
            margin: 0 auto;
            border: 4px solid var(--primary-color);
        }

        .profile-header img:hover,
        .default-profile:hover {
            transform: scale(1.1);
        }

        .default-profile {
            background: var(--primary-color);
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 3rem;
            border: none;
        }

        .profile-header h1 {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-top: 15px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .profile-header p {
            font-size: 1.1rem;
            color: var(--text-color);
            margin: 10px 0 20px;
        }

        .stats {
            display: flex;
            justify-content: space-around;
            gap: 40px;
            margin: 30px 0;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .stats span {
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .btn {
            padding: 15px 25px;
            background: var(--primary-color);
            color: white;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: bold;
            transition: background 0.3s ease-in-out, transform 0.3s ease-in-out;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: var(--secondary-color);
            transform: scale(1.05);
        }

        .collections {
            margin-top: 60px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }

        .collection {
            background: var(--primary-color);
            border-radius: var(--border-radius-large);
            box-shadow: var(--box-shadow-medium);
            padding: 25px;
            color: white;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .collection:hover {
            transform: scale(1.05);
            box-shadow: var(--box-shadow-light);
        }

        .collection h2 {
            font-size: 1.6rem;
            margin-bottom: 20px;
            color: white;
            letter-spacing: 1px;
        }

        .collection ul {
            list-style: none;
            padding: 0;
        }

        .collection li {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            font-size: 1rem;
            color: #f1f1f1;
        }

        .collection img,
        .default-plant {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            background: var(--secondary-color);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2rem;
            color: white;
        }

        .collection span {
            font-size: 1.1rem;
            color: #f1f1f1;
        }

        .user-activity {
            margin-top: 60px;
        }

        .section {
            background: #f9f9f9;
            border-radius: var(--border-radius-large);
            box-shadow: var(--box-shadow-light);
            padding: 25px;
            margin-bottom: 30px;
            text-align: left;
        }

        .section h2 {
            font-size: 1.6rem;
            color: var(--primary-color);
            margin-bottom: 20px;
            border-bottom: 3px solid var(--primary-color);
            padding-bottom: 10px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: var(--gap-large);
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

        .timestamp {
            font-size: var(--font-size-xsmall);
            color: #777;
            margin-top: var(--spacing-small);
        }

        @media (max-width: 768px) {
            .stats {
                flex-direction: column;
                gap: 30px;
            }

            .buttons {
                flex-direction: column;
            }

            .collections {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 30px;
            }

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

    <div class="container">
        {{-- Profile Header --}}
        <div class="profile-header">
            @if ($user->profile_picture)
                <img src="{{ asset('storage/images/assigned_profile_pictures/' . $user->profile_picture) }}"
                    alt="{{ $user->name }}">
            @else
                <div class="default-profile">
                    <i class="fas fa-user"></i>
                </div>
            @endif
            <h1>{{ $user->name }}</h1>
            <p>{{ $user->description }}</p>
            <div class="stats">
                <span><i class="fas fa-users"></i> Followers: {{ $user->followers_count }}</span>
                <span><i class="fas fa-user-friends"></i> Following: {{ $user->following_count }}</span>
            </div>
            @auth
                @if (auth()->id() !== $user->id)
                    @php
                        $isFollowing = $user
                            ->followers()
                            ->where('follower_id', auth()->id())
                            ->exists();
                    @endphp
                    @if ($isFollowing)
                        <form action="{{ route('users.unfollow', $user) }}" method="POST">
                            @csrf
                            <button class="btn" type="submit">Unfollow</button>
                        </form>
                    @else
                        <form action="{{ route('users.follow', $user) }}" method="POST">
                            @csrf
                            <button class="btn" type="submit">Follow</button>
                        </form>
                    @endif
                @else
                    <div class="buttons">
                        <a href="{{ route('profile.edit', $user) }}" class="btn">Edit Profile</a>
                    </div>
                @endif
            @endauth



        </div>

        {{-- Collections --}}
        <div class="collections">
            @foreach ($collections as $type => $plants)
                <div class="collection">
                    <h2>{{ ucfirst(str_replace('plantsI', 'Plants I ', $type)) }}</h2>
                    <ul>
                        @forelse ($plants as $collection)
                            <li>
                                @if ($collection->plant)
                                    <a href="{{ route('plants.show', $collection->plant->id) }}"
                                        style="display: flex; align-items: center; gap: 15px; text-decoration: none;">
                                        @if ($collection->plant->image && file_exists(storage_path('app/public/images/plants/' . $collection->plant->image)))
                                            <img src="{{ asset('storage/images/plants/' . $collection->plant->image) }}"
                                                alt="{{ $collection->plant->name }}" loading="lazy">
                                        @else
                                            <div class="default-plant">
                                                <i class="fas fa-seedling"></i>
                                            </div>
                                        @endif
                                        <span>{{ $collection->plant->name }}</span>
                                    </a>
                                @else
                                    <div style="display: flex; align-items: center; gap: 15px;">
                                        <div class="default-plant">
                                            <i class="fas fa-seedling"></i>
                                        </div>
                                        <span>Unnamed Plant</span>
                                    </div>
                                @endif
                            </li>

                        @empty
                            <p>No plants in this collection.</p>
                        @endforelse
                    </ul>
                </div>
            @endforeach
        </div>

        {{-- User Activity (Posts) --}}
        @if ($posts->isNotEmpty())
            <div class="user-activity">
                <div class="section">
                    <h2>Posts</h2>
                    <div class="grid-container">
                        @foreach ($posts as $post)
                            <a href="{{ route('posts.show', $post->id) }}" class="post-link">
                                <div class="card post-card">
                                    <div class="card-content">
                                        @if ($post->image)
                                            <img src="{{ asset('storage/images/posts/' . $post->image) }}"
                                                alt="{{ $post->title }}" loading="lazy">
                                        @endif
                                        <h3>{{ $post->title }}</h3>
                                        <p>{{ Str::limit($post->content, 80) }}</p>
                                    </div>
                                    <span class="timestamp">Posted on {{ $post->created_at->format('Y-m-d') }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</body>

</html>
