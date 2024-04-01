<!DOCTYPE html>
<?php
require("connection.php");  //connecting to the database

// Initialize error variable
$error = "";

if(isset($_POST['Login']))
{
    $admin_name = $_POST['admin_name']; // Correct variable name for username
    $admin_password = $_POST['_admin_password']; // Correct variable name for password
    
    // SQL Injection vulnerability: Use prepared statements
    $query = "SELECT * FROM `admin_login` WHERE `Admin_Name`=? AND `Admin_Password`=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $admin_name, $admin_password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows == 1)
    {
        session_start();
        $_SESSION['admin'] = $admin_name; // Set admin session variable
        header("Location: admin_panel.php");
        exit(); // Added exit() to prevent further execution
    }
    else

    {
        $error = "Incorrect Username or Password"; // Set error message
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form class="login-form" method="post">
            <input type="text" name="admin_name" placeholder="Username" required="required"><br>
            <input type="password" name="_admin_password" placeholder="Password" required="required"><br>
            <input type="submit" name="Login" value="Login">
        </form>

        <?php if(!empty($error)) { ?>
            <div class="error">
                <?php echo $error; ?>
        </div>
        <?php } 
        ?>
    </div>
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

        .login-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        .login-container h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s ease;
        }

        .login-form input[type="text"]:focus,
        .login-form input[type="password"]:focus {
            border-color: #4caf50;
        }

        .login-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-form input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</body>
</html>
