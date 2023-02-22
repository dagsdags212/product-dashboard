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
        <a href="/users/login">Login</a>   
    </header>
    <h1>Register</h1>
    <form action="/users/add_user" method="post">
        <label for="email">Email address:</label>
        <input type="text" id="email" name="email">
        <label for="first_name">First name:</label>
        <input type="text" id="first_name" name="first_name">
        <label for="last_name">Last name:</label>
        <input type="text" id="last_name" name="last_name">
        <label for="password">Password:</label>
        <input type="text" id="password" name="password">
        <label for="password_conf">Confirm Password:</label>
        <input type="text" id="password_conf" name="password_conf">
        <input type="submit" value="Log in">
    </form>
    <a href="/users/login">Already have an account? Login</a>
</body>
</html>