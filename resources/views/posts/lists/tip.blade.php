<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Tips</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: var(--font-primary);
            margin: 0;
            padding: 0;
            background: var(--bg-light);
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            width: 90%;
            padding: var(--spacing-large);
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow-light);
            margin-top: 40px;
        }

        h1 {
            text-align: center;
            font-size: var(--font-size-large);
            color: var(--primary-color);
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: var(--spacing-medium);
        }

        .filter-bar {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            margin-bottom: var(--spacing-medium);
        }

        .filter-bar input,
        .filter-bar select {
            padding: var(--spacing-small);
            border: 1px solid #ccc;
            border-radius: 30px;
            font-size: var(--font-size-medium);
            background-color: #f9f9f9;
            color: var(--dark-text);
            width: auto;
            min-width: 200px;
            flex: 1 1 200px;
            max-width: 250px;
        }

        .filter-bar button,
        .create-btn {
            white-space: nowrap;
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            font-size: var(--font-size-medium);
            padding: var(--spacing-small) var(--spacing-medium);
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .filter-bar button:hover,
        .create-btn:hover {
            transform: scale(1.05);
        }

        .create-btn {
            display: block;
            width: fit-content;
            margin: var(--spacing-medium) auto;
        }

        @media (max-width: 768px) {
            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-bar input,
            .filter-bar select,
            .filter-bar button {
                width: 100%;
            }
        }

        .tips-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: var(--spacing-medium);
        }

        .tip-card {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow-light);
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 300px;
            position: relative;
            padding: var(--spacing-medium);
            text-align: center;
        }

        .tip-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--box-shadow-medium);
        }

        .tip-card h3 {
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin-bottom: var(--spacing-small);
            font-weight: 600;
            text-transform: uppercase;
        }

        .tip-card p {
            font-size: var(--font-size-medium);
            color: var(--dark-text);
            line-height: 1.6;
            flex-grow: 1;
            padding: 0 var(--spacing-small);
        }

        .tip-card .author {
            font-size: var(--font-size-medium);
            color: var(--secondary-color);
            font-weight: 600;
            margin-top: var(--spacing-small);
        }

        .tip-card .date {
            font-size: var(--font-size-small);
            color: var(--dark-text);
            margin-top: var(--spacing-small);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .tip-card .date i {
            color: var(--secondary-color);
        }

        .tip-card .view-btn {
            padding: var(--spacing-small) var(--spacing-medium);
            background: var(--primary-color);
            color: var(--white);
            border: 2px solid #388e3c;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: var(--font-size-medium);
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .tip-card .view-btn:hover {
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-bar input,
            .filter-bar select,
            .filter-bar button {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <x-navbar />

    <div class="container">
        <h1>Tips Posts</h1>

        <form method="GET" action="{{ route('posts.lists.show', ['type' => 'tip']) }}" class="filter-bar">
            <div class="filters">
                <input type="text" name="search" placeholder="Search Tips..." value="{{ request('search') }}">
            </div>

            <div class="sort-actions">
                <select name="sort_by" onchange="this.form.submit()">
                    <option value="latest" {{ request('sort_by') === 'latest' ? 'selected' : '' }}>Sort by: Latest
                    </option>
                    <option value="a-z" {{ request('sort_by') === 'a-z' ? 'selected' : '' }}>Sort by: A-Z</option>
                    <option value="z-a" {{ request('sort_by') === 'z-a' ? 'selected' : '' }}>Sort by: Z-A</option>
                    <option value="oldest" {{ request('sort_by') === 'oldest' ? 'selected' : '' }}>Sort by: Oldest
                    </option>
                </select>
            </div>
        </form>

        <!-- Create Button -->
        <a href="{{ route('posts.create', ['type' => 'tip']) }}" class="create-btn">Create New Tip</a>

        <div class="tips-grid" id="tipsGrid">
            @forelse ($posts as $tip)
                <div class="tip-card">
                    <h3>{{ $tip->title }}</h3>
                    <p>{{ Str::limit($tip->content, 100) }}</p>
                    <p class="author">Posted by: {{ $tip->user->name }}</p>
                    <p class="date">
                        <i class="fas fa-calendar-alt"></i> {{ $tip->created_at->format('M d, Y') }}
                    </p>
                    <a href="{{ route('posts.show', $tip->id) }}" class="view-btn"><i class="fas fa-eye"></i> View Tip</a>
                </div>
            @empty
                <p class="no-tips" style="text-align: center; font-size: 16px; color: #666;">
                    No tips available. Be the first to add one!
                </p>
            @endforelse
        </div>
    </div>
</body>

</html>
