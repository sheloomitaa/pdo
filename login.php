<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT Bendicar</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f5e0c3, #d7b79a); /* Warna gradien cream dan coklat muda */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: #fff;  /* Latar belakang putih */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #4f3b31; /* Coklat tua untuk teks */
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #4f3b31; /* Coklat tua untuk label */
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #d7b79a; /* Border coklat muda */
            border-radius: 5px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #4f3b31; /* Coklat tua saat fokus */
        }

        .btn-login {
            width: 100%;
            background: #d7b79a; /* Coklat muda untuk tombol */
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn-login:hover {
            background: #4f3b31; /* Coklat tua saat hover */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login PT Bendicar</h2>
        <form action="validate.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn-login">Login</button>
</form>

</body>
</html>