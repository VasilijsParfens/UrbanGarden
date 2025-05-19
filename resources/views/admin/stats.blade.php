<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard Stats</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: var(--font-primary);
            margin: 0;
            padding: 0;
            background: var(--gradient-bg);
            color: var(--text-color);
        }
        .nav-tabs {
            display: flex;
            justify-content: center;
            gap: var(--gap-large);
            margin: var(--margin-medium) 0;
            background-color: var(--primary-color);
            padding: var(--padding-small);
            border-radius: var(--border-radius);
        }

        .nav-tabs a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: var(--font-weight-bold);
            font-size: var(--font-size-medium);
            padding: var(--padding-small);
            border-radius: var(--border-radius);
            transition: background-color var(--transition-speed), color var(--transition-speed);
        }

        .nav-tabs a:hover {
            background-color: var(--secondary-color);
            color: var(--white);
        }

        .nav-tabs a.active {
            background-color: var(--secondary-color);
            color: var(--white);
        }

        .admin-header {
            background: var(--bg-light);
            backdrop-filter: blur(10px);
            padding: var(--margin-medium);
            text-align: center;
            font-size: var(--font-size-large);
            font-weight: var(--font-weight-bold);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--gap-medium);
            box-shadow: var(--box-shadow-light);
            position: relative;
            top: 0;
            z-index: 100;
            color: var(--primary-color);
        }

        .admin-header i {
            font-size: var(--font-size-large);
        }

        .container {
            max-width: 1200px;
            margin: var(--margin-medium) auto;
            padding: var(--margin-large);
            background: var(--bg-light-transparent);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius-large);
            box-shadow: var(--box-shadow-medium);
            background: linear-gradient(135deg, var(--white), #F1FAEE);
        }

        .stats-section {
            margin-bottom: var(--margin-large);
        }

        .stats-section h2 {
            font-size: var(--font-size-large);
            color: var(--primary-color);
            margin-bottom: var(--margin-medium);
            font-weight: var(--font-weight-bold);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--gap-large);
        }

        .stat-card {
            background: var(--bg-light);
            padding: var(--padding-large);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow-light);
            text-align: center;
        }

        .stat-card h3 {
            font-size: var(--font-size-medium);
            color: var(--primary-color);
            margin-bottom: var(--margin-small);
        }

        .stat-card p {
            font-size: var(--font-size-large);
            color: var(--dark-text);
            margin: 0;
        }

        .table-section {
            margin-top: var(--margin-large);
        }

        .table-section h2 {
            font-size: var(--font-size-large);
            color: var(--primary-color);
            margin-bottom: var(--margin-medium);
            font-weight: var(--font-weight-bold);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--bg-light-transparent);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius-large);
            overflow: hidden;
            box-shadow: var(--box-shadow-light);
        }

        table th,
        table td {
            padding: var(--padding-large);
            text-align: left;
            color: var(--primary-color);
        }

        table th {
            background: var(--primary-color);
            color: var(--white);
            font-weight: var(--font-weight-regular);
            cursor: pointer;
            transition: background var(--transition-speed);
            position: sticky;
            top: 0;
            z-index: 1;
        }

        table th:hover {
            background: var(--secondary-color);
        }

        table td {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            color: var(--dark-text);
            overflow: visible;
        }

        table tr:hover td {
            background-color: rgba(45, 106, 79, 0.1);
            color: var(--primary-color);
        }

        table tr:last-child td {
            border-bottom: none;
        }
    </style>
</head>

<body>
    <x-navbar />

    <div class="nav-tabs">
        <a href="{{ route('admin.plants.index')}}">Plants</a>
        <a href="{{ route('admin.users.index')}}">Users</a>
        <a href="{{ route('admin.posts.index')}}">Posts</a>
        <a href="{{ route('admin.post_comments') }}">Post Comments</a>
        <a href="{{ route('admin.plant_comments') }}">Plant Comments</a>
        <a href="{{ route('admin.dashboard.stats')}}">Statistics</a>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Users Stats -->
        <div class="stats-section">
            <h2>Users Statistics</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Users</h3>
                    <p>{{ $stats['users']['total'] }}</p>
                </div>
                <div class="stat-card">
                    <h3>Admins</h3>
                    <p>{{ $stats['users']['admins'] }}</p>
                </div>
                <div class="stat-card">
                    <h3>Regular Users</h3>
                    <p>{{ $stats['users']['regular_users'] }}</p>
                </div>
            </div>
        </div>

        <!-- Plants Stats -->
        <div class="stats-section">
            <h2>Plants Statistics</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Plants</h3>
                    <p>{{ $stats['plants']['total'] }}</p>
                </div>
            </div>
            <div class="table-section">
                <h2>Watering Frequencies</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Watering Frequency</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stats['plants']['watering_frequencies'] as $frequency)
                            <tr>
                                <td>{{ $frequency->watering_frequency }}</td>
                                <td>{{ $frequency->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="table-section">
                <h2>Sunlight Requirements</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Sunlight Requirement</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stats['plants']['sunlight_requirements'] as $sunlight)
                            <tr>
                                <td>{{ $sunlight->sunlight }}</td>
                                <td>{{ $sunlight->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Posts Stats -->
        <div class="stats-section">
            <h2>Posts Statistics</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Posts</h3>
                    <p>{{ $stats['posts']['total'] }}</p>
                </div>
                <div class="stat-card">
                    <h3>Total Comments</h3>
                    <p>{{ $stats['posts']['comments_total'] }}</p>
                </div>
                <div class="stat-card">
                    <h3>Average Comments per Post</h3>
                    <p>{{ $stats['posts']['comments_average_per_post'] }}</p>
                </div>
            </div>
            <div class="table-section">
                <h2>Posts by Type</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Post Type</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stats['posts']['by_type'] as $type)
                            <tr>
                                <td>{{ $type->type }}</td>
                                <td>{{ $type->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Plant Comments Stats -->
        <div class="stats-section">
            <h2>Plant Comments Statistics</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Plant Comments</h3>
                    <p>{{ $stats['plant_comments']['total'] }}</p>
                </div>
            </div>
        </div>

        <!-- Collections Stats -->
        <div class="stats-section">
            <div class="table-section">
                <h2>Collections by Type</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Collection Type</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stats['collections']['by_type'] as $collection)
                            <tr>
                                <td>{{ $collection->collection_type }}</td>
                                <td>{{ $collection->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Followers Stats -->
        <div class="stats-section">
            <h2>Followers Statistics</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Followers</h3>
                    <p>{{ $stats['followers']['total'] }}</p>
                </div>
            </div>
            <div class="table-section">
                <h2>Top Followed Users</h2>
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Followers Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stats['followers']['top_followed_users'] as $follower)
                            <tr>
                                <td>{{ $follower->followed->name }}</td>
                                <td>{{ $follower->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
