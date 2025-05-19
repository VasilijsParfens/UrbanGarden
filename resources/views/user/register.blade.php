<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
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

        #password-strength {
            height: 5px;
            background: #eee;
            margin-top: 5px;
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        #password-strength-bar {
            height: 100%;
            width: 0%;
            background: red;
            border-radius: var(--border-radius);
            transition: width 0.3s ease, background 0.3s ease;
        }

        #message {
            display: none;
            margin-top: 20px;
            padding: 10px;
            border-radius: var(--border-radius);
            font-size: 14px;
        }

        .login-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color var(--transition-speed) ease;
        }

        .login-link:hover {
            color: var(--tertiary-color);
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            text-align: left;
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
        <h1>Join the Community</h1>
        <p>Create an account and start growing</p>

        <form action="{{ route('register') }}" method="POST" id="registration-form">
            @csrf
            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name"
                    value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email"
                    value="{{ old('email') }}" required aria-describedby="email-help">
                <small id="email-help" style="display: none; color: red;">Please enter a valid email address.</small>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Enter your password" required
                        minlength="8">
                    <i class="fas fa-eye" id="toggle-password"></i>
                </div>
                <div id="password-strength">
                    <div id="password-strength-bar"></div>
                </div>
                <small id="password-error" style="display: none; color: red;">Password must be at least 8 characters
                    long.</small>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    placeholder="Confirm your password" required>
            </div>

            <button type="submit" class="btn" id="submit-btn">
                <span id="btn-text">Register</span>
                <i class="fas fa-spinner fa-spin" id="spinner"></i>
            </button>
        </form>

        <p>Already have an account? <a href="{{ route('login') }}" class="login-link">Login here</a></p>
        <div id="message"></div>
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
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                this.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });

        // JavaScript for Password Strength Indicator
        document.getElementById('password').addEventListener('input', function() {
            const strengthBar = document.getElementById('password-strength-bar');
            const strength = calculatePasswordStrength(this.value);
            strengthBar.style.width = strength + '%';
            strengthBar.style.backgroundColor = strength < 50 ? 'red' : strength < 75 ? 'orange' : 'green';
        });

        function calculatePasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength += 40;
            if (/[A-Z]/.test(password)) strength += 20;
            if (/[0-9]/.test(password)) strength += 20;
            if (/[^A-Za-z0-9]/.test(password)) strength += 20;
            return Math.min(strength, 100);
        }

        // JavaScript for Form Submission
        document.getElementById('registration-form').addEventListener('submit', function(e) {
                    e.preventDefault(); // Prevent the default form submission

                    const form = e.target;
                    const formData = new FormData(form);
                    const submitBtn = document.getElementById('submit-btn');
                    const btnText = document.getElementById('btn-text');
                    const spinner = document.getElementById('spinner');

                    // Show spinner and hide button text
                    btnText.style.display = 'none';
                    spinner.style.display = 'inline-block';

                    // Send form data to the server using AJAX
                    fetch(form.action, {
                            method: form.method,
                            body: formData,
                            headers: {
                                'Accept': 'application/json', // ensures Laravel treats it as JSON request
                            },
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(err => {
                                    throw err;
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            showMessage(data.message || 'Registration successful!', true);
                            setTimeout(() => {
                                window.location.href = data.redirect || '/';
                            }, 1000);
                        })
                        .catch(error => {
                            if (error.errors) {
                                showMessage(Object.values(error.errors).flat().join('\n'), false);
                            } else {
                                showMessage(error.error || 'An error occurred during registration.', false);
                            }
                        });


                    function showMessage(message, isSuccess) {
                        const messageDiv = document.getElementById('message');
                        messageDiv.innerHTML = message;
                        messageDiv.style.display = 'block';
                        messageDiv.style.backgroundColor = isSuccess ? '#d4edda' : '#f8d7da';
                        messageDiv.style.color = isSuccess ? '#155724' : '#721c24';
                    }
    </script>
</body>

</html>
