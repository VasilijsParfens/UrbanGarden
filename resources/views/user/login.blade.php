<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
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

        /* Main Container */
        .container {
            max-width: 450px;
            width: 100%;
            background: var(--bg-light);
            padding: 30px;
            border-radius: var(--border-radius-large);
            box-shadow: var(--box-shadow-medium);
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
            margin-top: 20px;
            /* Adjust margin to avoid overlap with navbar */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 28px;
            font-weight: 700;
        }

        p {
            color: var(--primary-color);
            margin-bottom: 25px;
            font-size: 16px;
            font-weight: 500;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            width: 100%;
            margin-bottom: 20px;
            align-items: stretch;
        }

        .form-group label {
            font-weight: 500;
            margin-bottom: 6px;
            font-size: 14px;
            color: var(--primary-color);
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: var(--border-radius);
            outline: none;
            font-size: 14px;
            transition: border-color var(--transition-speed) ease;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: var(--primary-color);
        }

        .password-container {
            position: relative;
        }

        .password-container i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--primary-color);
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: var(--border-radius);
            background: var(--primary-color);
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background var(--transition-speed) ease;
            margin-top: 10px;
            position: relative;
        }

        .btn:hover {
            background: var(--tertiary-color);
        }

        #btn-text {
            display: inline-block;
        }

        #spinner {
            display: none;
            margin-left: 10px;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        .register-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color var(--transition-speed) ease;
        }

        .register-link:hover {
            color: var(--tertiary-color);
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            .btn {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <x-navbar />

    <!-- Main Content -->
    <div class="container">
        <h1>Welcome Back!</h1>
        <p>Log in to access your garden</p>
        <form id="login-form" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Enter your password" required />
                    <i class="fas fa-eye" id="toggle-password"></i>
                </div>
            </div>
            <button type="submit" class="btn" id="submit-btn">
                <span id="btn-text">Log In</span>
                <i class="fas fa-spinner fa-spin" id="spinner"></i>
            </button>
            <div id="error-message" class="error-message" style="display: none;"></div>
        </form>
        <p>Don't have an account? <a href="{{ route('register') }}" class="register-link">Register here</a></p>
    </div>

    <script>
        // JavaScript for Navbar Toggle
        function toggleMenu() {
            const menu = document.getElementById('navbarMenu');
            menu.classList.toggle('active');
        }

        function toggleTheme() {
            document.body.classList.toggle('dark-mode');
        }

        // JavaScript for Password Toggle
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });

        // JavaScript for Form Submission
        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            const form = e.target;
            const formData = new FormData(form);
            const submitBtn = document.getElementById('submit-btn');
            const btnText = document.getElementById('btn-text');
            const spinner = document.getElementById('spinner');
            const errorMessageDiv = document.getElementById('error-message');

            // Show spinner and hide button text
            btnText.style.display = 'none';
            spinner.style.display = 'inline-block';
            errorMessageDiv.style.display = 'none';

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                })
                .then(async response => {
                    const json = await response.json();

                    if (response.ok) {
                        if (json.redirect) {
                            window.location.href = json.redirect;
                        } else {
                            // fallback if no redirect is returned
                            window.location.reload();
                        }
                    } else {
                        // Handle validation or login error
                        console.error(json);
                        // Show error message to user
                    }
                })
                .catch(error => {
                    console.error('Fetch failed:', error);
                });
        });
    </script>
</body>

</html>
