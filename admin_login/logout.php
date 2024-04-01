<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .logout-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
        }

        .logout-container h2 {
            margin-top: 0;
            color: #333;
        }

        .logout-message {
            margin-top: 20px;
            color: #555;
        }

        .login-link {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .login-link:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <h2>Logged out successfully!</h2>
        <p class="logout-message">You have been successfully logged out of your account.</p>
        <a href="admin_login.php" class="login-link">Login Again</a>
    </div>
</body>
</html>
