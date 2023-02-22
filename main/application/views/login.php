<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <header>
        <p>V88 Merchandise</p>
        <a href="/users/register">Register</a>   
    </header>
    <h1>Login</h1>
    <form action="/users/login" method="post">
        <label for="email">Email address:</label>
        <input type="text" id="email" name="email">
        <label for="password">Password:</label>
        <input type="text" id="password" name="password">
        <input type="submit" value="Log in">
    </form>
    <a href="/users/register">Don't have an account? Register</a>
</body>
</html>