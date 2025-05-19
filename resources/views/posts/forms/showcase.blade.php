<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showcase Your Plant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        .showcase-page {
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

        .showcase-page .container {
            max-width: 450px;
            width: 100%;
            background: var(--bg-light);
            padding: 30px;
            border-radius: var(--border-radius-large);
            box-shadow: var(--box-shadow-medium);
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
            margin-top: 20px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .showcase-page h2 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .showcase-page form {
            display: flex;
            flex-direction: column;
        }

        .showcase-page label {
            margin: 10px 0 5px;
            font-weight: bold;
            color: var(--primary-color);
        }

        .showcase-page input[type="text"],
        .showcase-page textarea,
        .showcase-page input[type="file"] {
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .showcase-page input:focus,
        .showcase-page textarea:focus {
            outline: none;
            border-color: #66bb6a;
            box-shadow: 0 0 8px rgba(102, 187, 106, 0.5);
        }

        .showcase-page textarea {
            resize: vertical;
        }

        .showcase-page button {
            margin-top: 20px;
            padding: 12px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.1rem;
            transition: background 0.3s ease;
        }

        .showcase-page button:hover {
            background: var(--secondary-color);
        }

        .showcase-page button:active {
            transform: scale(0.98);
        }
    </style>
</head>

<body>
    <x-navbar />
    <div class="showcase-page">
        <div class="container">
            <h2><i class="fas fa-seedling"></i> Showcase Your Plant</h2>
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="showcase">

                <label for="title">Plant Name / Title</label>
                <input type="text" id="title" name="title" placeholder="Give your plant a name or title..." required>

                <label for="content">Description</label>
                <textarea id="content" name="content" rows="4" placeholder="Describe your plant..." required></textarea>

                <label for="image">Upload Image</label>
                <input type="file" id="image" name="image" accept="image/*">

                <button type="submit"><i class="fas fa-paper-plane"></i> Share Showcase</button>
            </form>
        </div>
    </div>
</body>

</html>
