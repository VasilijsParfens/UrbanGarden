<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask a Plant Question</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>

        .ask-question-page {
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

        .ask-question-page .container {
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

        .ask-question-page h2 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .ask-question-page form {
            display: flex;
            flex-direction: column;
        }

        .ask-question-page label {
            margin: 10px 0 5px;
            font-weight: bold;
            color: var(--primary-color);
        }

        .ask-question-page input[type="text"],
        .ask-question-page textarea {
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .ask-question-page input:focus,
        .ask-question-page textarea:focus {
            outline: none;
            border-color: #66bb6a;
            box-shadow: 0 0 8px rgba(102, 187, 106, 0.5);
        }

        .ask-question-page textarea {
            resize: vertical;
        }

        .ask-question-page button {
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

        .ask-question-page button:hover {
            background: var(--secondary-color);
        }

        .ask-question-page button:active {
            transform: scale(0.98);
        }
    </style>
</head>

<body>
    <x-navbar />
    <div class="ask-question-page">
        <div class="container">
            <h2><i class="fas fa-question-circle"></i> Ask a Plant Question</h2>
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="question">

                <label for="title">Question Title</label>
                <input type="text" id="title" name="title" placeholder="What's your question?" required>

                <label for="content">Details</label>
                <textarea id="content" name="content" rows="4" placeholder="Provide more context or details..." required></textarea>

                <button type="submit"><i class="fas fa-paper-plane"></i> Submit Question</button>
            </form>
        </div>
    </div>
</body>

</html>
