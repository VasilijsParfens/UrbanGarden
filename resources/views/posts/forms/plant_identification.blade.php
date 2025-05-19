<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identify a Plant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        .plant-identification-page {
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

        .plant-identification-page .container {
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

        .plant-identification-page h2 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .plant-identification-page form {
            display: flex;
            flex-direction: column;
        }

        .plant-identification-page label {
            margin: 10px 0 5px;
            font-weight: bold;
            color: var(--primary-color);
        }

        .plant-identification-page input[type="text"],
        .plant-identification-page textarea,
        .plant-identification-page input[type="file"] {
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .plant-identification-page input:focus,
        .plant-identification-page textarea:focus {
            outline: none;
            border-color: #66bb6a;
            box-shadow: 0 0 8px rgba(102, 187, 106, 0.5);
        }

        .plant-identification-page textarea {
            resize: vertical;
        }

        .plant-identification-page button {
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

        .plant-identification-page button:hover {
            background: var(--secondary-color);
        }

        .plant-identification-page button:active {
            transform: scale(0.98);
        }
    </style>
</head>

<body>
    <x-navbar />
    <div class="plant-identification-page">
        <div class="container">
            <h2><i class="fas fa-search"></i> Identify a Plant</h2>
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="plant_identification">

                <label for="plant_title">Question Title</label>
                <input type="text" id="plant_title" name="plant_title" placeholder="What's your question?" required>

                <label for="plant_content">Additional Details</label>
                <textarea id="plant_content" name="plant_content" rows="4"
                    placeholder="Describe the plant's appearance, location, or any other relevant details..." required></textarea>

                <label for="plant_image">Upload Image</label>
                <input type="file" id="plant_image" name="plant_image" accept="image/*" required>

                <button type="submit"><i class="fas fa-paper-plane"></i> Submit Request</button>
            </form>
        </div>
    </div>
</body>


</html>
