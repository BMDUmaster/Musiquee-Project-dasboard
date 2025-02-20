<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musique Admin Login</title>
    <style>
        /* General Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            padding: 2rem;
            width: 350px;
            text-align: center;
        }

        .login-box .logo img {
            width: 60px;
            margin-bottom: 1rem;
        }

        .login-box h1 {
            margin: 0;
            font-size: 2rem;
            color: #fff;
        }

        .login-box p {
            margin: 1rem 0 2rem;
            color: #ddd;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group input {
            width: 83%;
            padding: 0.75rem 2.5rem 0.75rem 1rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .input-group input:focus {
            border-color: #23d5ab;
            outline: none;
        }

        .input-group .icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.7);
        }

        button {
            width: 100%;
            padding: 0.75rem;
            background: #23d5ab;
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background: #1e9c7e;
            transform: translateY(-2px);
        }

        button:active {
            transform: translateY(0);
        }

        @media print {

            html,
            body {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <img src="{{ asset('assets/img/Group muzique logo 2.svg') }}" alt="Musically Logo">
                <h1>Musique</h1>
            </div>
            <p>Welcome back! Please log in to continue.</p>
            <form action="{{ url('login') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    <span class="icon">✉️</span>
                    @error(session('email'))
                        <div class="text-danger">{{ session('email') }}</div>
                    @enderror
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    <span class="icon">🔒</span>
                    @error(session('password'))
                        <div class="text-danger">{{ session('password') }}</div>
                    @enderror
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>
