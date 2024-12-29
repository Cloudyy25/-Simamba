{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>

<body class="bg-gray-100 flex flex-col justify-center items-center h-screen">
    <section class="container max-w-md bg-white p-8 rounded-lg shadow-lg">
        <!-- Form login -->
        <form action="{{ route('login') }}" method="post" enctype="multipart/form-data" class="login">
@csrf <!-- Menambahkan token CSRF untuk keamanan -->
<h1 class="text-3xl mb-4">Masuk Akun</h1>

<!-- Input username atau email -->
<input type="text" name="username_or_email" placeholder="Username atau Email" maxlength="50" required
    class="w-full mb-2 p-3 rounded-lg border border-gray-300">
@error('username_or_email')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror

<!-- Input password -->
<input type="password" name="pass" placeholder="Password" maxlength="20" required
    class="w-full mb-2 p-3 rounded-lg border border-gray-300">
@error('pass')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror

<!-- Tombol submit -->
<button type="submit"
    class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition">Login</button>

<!-- Error umum -->
@if ($errors->has('error'))
<p class="text-red-500 text-sm mt-4">{{ $errors->first('error') }}</p>
@endif
</form>

</section>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simamba Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
    <style>
        :root {
            --primary-color: #f25019;
            --secondary-color: #f4d09e;
            --text-color: #333333;
            --subtitle-color: #ee9641;
            --bg-gradient: linear-gradient(90deg, rgba(254, 220, 197, 0.8), rgba(242, 194, 64, 0.7));
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--secondary-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            display: flex;
            flex-direction: column;
            background: var(--bg-gradient);
            border-radius: 16px;
            width: 80%;
            max-width: 1200px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .login-content {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 24px;
            backdrop-filter: blur(10.672px);
            flex: 1;
            padding: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin-right: 20px;
        }

        .login-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 1rem;
            text-align: center;
        }

        .login-subtitle {
            font-size: 1.1rem;
            color: var(--subtitle-color);
            margin-bottom: 2rem;
            text-align: center;
        }

        .input-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-color);
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-color);
            font-size: 1.2rem;
            line-height: 1;
        }

        .toggle-password img {
            width: 20px;
            height: 20px;
            margin-top: 30px;
        }

        .login-button {
            display: block;
            width: 100%;
            background: var(--primary-color);
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            transition: background 0.3s ease;
        }

        .login-button:hover {
            background: #d84216;
        }

        .illustration {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .illustration img {
            max-width: 80%;
            height: auto;
        }

        .popup-error {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px 20px;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            z-index: 1000;
            display: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .popup-error .close-btn {
            background: none;
            border: none;
            color: #721c24;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            margin-left: 15px;
        }

        .popup-error .close-btn:hover {
            color: #f25019;
        }

        @media screen and (max-width: 1050px) {
            .login-container {
                grid-gap: 5rem;
            }
        }

        @media screen and (max-width: 1000px) {
            .form-container {
                width: 290px;
            }

            .login-title {
                font-size: 2.4rem;
                margin: 8px 0;
            }

            .illustration img {
                width: 400px;
            }
        }

        @media screen and (max-width: 900px) {
            .login-container {
                flex-direction: column;
            }

            .illustration {
                display: none;
            }

            .form-container {
                margin-right: 0;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <!-- Popup Error -->
    @if ($errors->any())
    <div class="popup-error" id="popupError">
        <span>{{ $errors->first() }}</span>
        <button class="close-btn" onclick="closePopup()">×</button>
    </div>
    @endif

    <div class="login-container">
        <div class="login-content">
            <!-- Form container -->
            <div class="form-container">
                <h1 class="login-title">Login</h1>
                <p class="login-subtitle">Gunakan Email dan Password Akun BPS Anda</p>
                <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <label for="email">Username atau Email</label>
                        <input type="text" name="username_or_email" id="email"
                            placeholder="username atau username@bps.ac.id">
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" name="pass" id="password" placeholder="Password">
                        <span class="toggle-password" onclick="togglePassword()">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/visible.png" id="eye-icon"
                                alt="toggle password">
                        </span>
                    </div>
                    <button class="login-button" type="submit">Login</button>
                </form>
            </div>

            <!-- Illustration -->
            <div class="illustration">
                <img src="{{ asset('images/login.png') }}" alt="login">
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.src = "https://img.icons8.com/ios-glyphs/30/000000/invisible.png";
            } else {
                passwordField.type = 'password';
                eyeIcon.src = "https://img.icons8.com/ios-glyphs/30/000000/visible.png";
            }
        }

        // Tampilkan popup secara otomatis jika ada error
        document.addEventListener('DOMContentLoaded', function() {
            const popupError = document.getElementById('popupError');
            if (popupError) {
                popupError.style.display = 'block';
                setTimeout(() => popupError.style.display = 'none', 5000); // Sembunyikan otomatis setelah 5 detik
            }
        });

        // Fungsi untuk menutup popup
        function closePopup() {
            const popupError = document.getElementById('popupError');
            popupError.style.display = 'none';
        }
    </script>
</body>

</html>