<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>All Plants</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            /* Center the whole filter bar */
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
            /* Flex grow */
            max-width: 250px;
        }

        .filter-bar button {
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

        .filter-bar button:hover {
            transform: scale(1.05);
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


        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: var(--spacing-medium);
        }

        .plant-card {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow-light);
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .plant-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--box-shadow-medium);
        }

        .plant-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-content {
            padding: var(--spacing-medium);
            display: flex;
            flex-direction: column;
        }

        .card-content h3 {
            margin: 0 0 var(--spacing-small);
            font-size: 18px;
            color: var(--secondary-color);
            font-weight: 600;
            text-transform: uppercase;
        }

        .card-content .date {
            font-size: 13px;
            color: #777;
        }

        .pagination {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: var(--spacing-large);
        }

        .pagination li {
            list-style: none;
        }

        .pagination a,
        .pagination span {
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            text-decoration: none;
            color: var(--primary-color);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .pagination .active span,
        .pagination a:hover {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .pagination .disabled span {
            color: #aaa;
            pointer-events: none;
        }

        .filter-bar {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 20px;
        }

        .filters,
        .sort-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: flex-end;
        }

        .filters {
            flex: 3;
        }

        .sort-actions {
            flex: 1;
            justify-content: flex-end;
        }

        @media (max-width: 768px) {
            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .filters,
            .sort-actions {
                flex-direction: column;
                width: 100%;
            }

            .sort-actions {
                align-items: stretch;
            }
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

            .plant-card img {
                height: 160px;
            }
        }
    </style>
</head>

<body>
    <x-navbar />

    <div class="container">
        <h1>🌿 All Plants</h1>

        <form method="GET" action="{{ route('plants.index') }}" class="filter-bar">
            <div class="filters">
                <input type="text" name="search" placeholder="Search plants..." value="{{ request('search') }}">

                <select name="sunlight">
                    <option value="">All sunlight</option>
                    <option value="Full Sun" {{ request('sunlight') == 'Full Sun' ? 'selected' : '' }}>Full Sun</option>
                    <option value="Partial Sun" {{ request('sunlight') == 'Partial Sun' ? 'selected' : '' }}>Partial Sun
                    </option>
                    <option value="Shade" {{ request('sunlight') == 'Shade' ? 'selected' : '' }}>Shade</option>
                    <option value="Indirect Light" {{ request('sunlight') == 'Indirect Light' ? 'selected' : '' }}>
                        Indirect Light</option>
                </select>

                <select name="watering_frequency">
                    <option value="">All watering</option>
                    @foreach (['Daily', 'Weekly', 'Bi-Weekly', 'Monthly'] as $freq)
                        <option value="{{ $freq }}"
                            {{ request('watering_frequency') == $freq ? 'selected' : '' }}>{{ $freq }}</option>
                    @endforeach
                </select>

                <select name="soil_type">
                    <option value="">All soil types</option>
                    @foreach (['Sandy', 'Clay', 'Loamy', 'Peaty', 'Chalky', 'Silty'] as $soil)
                        <option value="{{ $soil }}" {{ request('soil_type') == $soil ? 'selected' : '' }}>
                            {{ $soil }}</option>
                    @endforeach
                </select>

                <select name="fertilizing">
                    <option value="">All fertilizing</option>
                    @foreach (['Weekly', 'Bi-Weekly', 'Monthly', 'Quarterly', 'Rarely'] as $fertilizing)
                        <option value="{{ $fertilizing }}"
                            {{ request('fertilizing') == $fertilizing ? 'selected' : '' }}>{{ $fertilizing }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="sort-actions">
                <select name="sort_by">
                    <option value="">Sort by</option>
                    <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)
                    </option>
                    <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)
                    </option>
                    <option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>Newest</option>
                    <option value="oldest" {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                </select>

                <button type="submit">Apply</button>
            </div>
        </form>



        <div class="grid-container">
            @forelse ($plants as $plant)
                <a href="{{ route('plants.show', $plant->id) }}" class="plant-card">
                    <img src="{{ asset('storage/images/plants/' . ($plant->image && file_exists(storage_path('app/public/images/plants/' . $plant->image)) ? $plant->image : 'no_image.jpg')) }}"
                        alt="{{ $plant->name }}"
                        onerror="this.onerror=null;this.src='{{ asset('storage/images/plants/no_image.jpg') }}';">
                    <div class="card-content">
                        <h3>{{ $plant->name }}</h3>
                        <span class="date">Added: {{ $plant->created_at->format('F d, Y') }}</span>
                    </div>
                </a>
            @empty
                <p style="text-align: center; font-size: 16px; color: #666;">No plants found.</p>
            @endforelse
        </div>

        @if ($plants->hasPages())
            <ul class="pagination">
                @if ($plants->onFirstPage())
                    <li class="disabled"><span>&laquo;</span></li>
                @else
                    <li><a href="{{ $plants->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                @endif

                @foreach ($plants->getUrlRange(1, $plants->lastPage()) as $page => $url)
                    @if ($page == $plants->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                @if ($plants->hasMorePages())
                    <li><a href="{{ $plants->nextPageUrl() }}" rel="next">&raquo;</a></li>
                @else
                    <li class="disabled"><span>&raquo;</span></li>
                @endif
            </ul>
        @endif
    </div>

</body>

</html>
