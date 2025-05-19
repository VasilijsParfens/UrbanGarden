<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit {{ $user->name }}'s Profile</title>
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
            transform: scale(1.05);
            border-color: var(--secondary-color);
        }

        .profile-header h1 {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-top: 15px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 1.1rem;
            color: var(--primary-color);
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            font-size: 1rem;
        }

        .form-group textarea {
            resize: vertical;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: 2px solid var(--secondary-color);
            border-color: var(--secondary-color);
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

        .back-btn {
            background: #e0e0e0;
            color: #333;
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
        }

        .back-btn:hover {
            background: #ccc;
        }

        .alert {
            color: red;
            margin-bottom: 20px;
            text-align: left;
        }

        .profile-preview img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 30px;
            }

            .profile-header h1 {
                font-size: 2rem;
            }

            .profile-header img {
                width: 120px;
                height: 120px;
            }

            .btn {
                font-size: 1rem;
                padding: 12px 20px;
            }
        }
    </style>
</head>

<body>
    <x-navbar />

    <div class="container">
        <div class="profile-header">
            @if ($user->profile_picture)
                <div class="profile-preview">
                    <img src="{{ asset('storage/images/assigned_profile_pictures/' . $user->profile_picture) }}"
                        alt="{{ $user->name }}">
                </div>
            @else
                <div class="default-profile">
                    <i class="fas fa-user"></i>
                </div>
            @endif
            <h1>Edit Profile</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture">
            </div>

            <button type="submit" class="btn" id="submitBtn">Update Profile</button>
        </form>

        <a href="{{ route('profile.show', $user->id) }}" class="btn back-btn">Back to Profile</a>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function () {
            document.getElementById('submitBtn').disabled = true;
            document.getElementById('submitBtn').textContent = 'Updating...';
        });
    </script>
</body>

</html>
