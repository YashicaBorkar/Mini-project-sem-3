<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
    background-image: url('vegetables.jpeg');
    background-size: cover;
    color: #fff;
    font-family: sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;  
}

.container {
    background-color: #333;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    display: flex;
    gap: 20px;
}

.left {
    width: 300px;
}

.right {
    background-color: #c71919;
    margin-left: 10px;
    padding: 30px;
    border-radius: 10px;
    color: white;
    width: 300px;
    text-align: center;
}

h2 {
    margin-bottom: 20px;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #333;
    color: #fff;
}

button {
    background-color: #c71919;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #f18181e9;
}

.links {
    margin-top: 20px;
    text-align: center;
}

a {
    color: #F08080;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
    </style>
</head>
<body>
    <main>
        <section class="container">
            <div class="left">
                <h2>Login</h2>
                <form action="includes/login.inc.php" method="post">
                    <div>
                        <label for="login-username">Username:</label>
                        <input type="text" id="login-username" name="username" placeholder="Enter your username">
                    </div>
                    <div>
                        <label for="login-password">Password:</label>
                        <input type="password" id="login-password" name="pwd" placeholder="Enter your password">
                    </div>
                    <button type="submit">Login</button>
                </form>
                <?php
                
                check_login_errors();
                ?>
                <div class="links">
                    <p>Don't have an account? <a href="signupmainpage.html">Sign Up</a></p>
                </div>
            </div>
            <div class="right">
                <h2>Welcome Back!</h2>
                <p>some message</p>
            </div>
            <div class="left">
                <h2>Sign up</h2>
                <form action="includes/signup.inc.php" method="post">
                    <div>
                        <label for="signup-username">Username:</label>
                        <input type="text" id="signup-username" name="username" placeholder="Enter your username">
                    </div>
                    <div>
                        <label for="signup-password">Password:</label>
                        <input type="password" id="signup-password" name="pwd" placeholder="Enter your password">
                    </div>
                    <div>
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" placeholder="Enter your email">
                    </div>
                    <button type="submit">Sign up</button>
                </form>
            </div>
            
            <?php
            check_signup_errors();

            ?>
        </section>
    </main>
</body>
</html>