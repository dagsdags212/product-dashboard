<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="/assets/css/profile.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <header>
        <p>V88 Merchandise</p>
        <a href="/users/logout">Log out</a>    
        <a href="/users/dashboard" id="dashboard_link">Dashboard</a>
        <a href="/users/profile" id="profile_link">Profile</a>
    </header>
    <h1>User Information</h1>
    <table>
<?php foreach($user_info as $key => $value) { ?>
        <tr>
            <td class="table-heading"><?= $key ?></td>
            <td><?= $value ?></td>
        </tr>
<?php } ?>
    </table>
    <h1>Edit Profile</h1>
    <form action="/users/update_info" method="post">
        <fieldset>
            <legend>Edit Information</legend>
            <input type="hidden" name="action" value="edit_info">
            <label for="email">Email address:</label>
            <input type="text" name="email" placeholder="Enter email address...">
            <label for="first_name">First name:</label>
            <input type="text" name="first_name" placeholder="Enter first name...">
            <label for="last_name">Last name:</label>
            <input type="text" name="last_name" placeholder="Enter last name...">
            <input type="submit" value="Save">
        </fieldset>
    </form>
    <form action="/users/update_info" method="post">
        <fieldset>
            <legend>Change Password</legend>
            <input type="hidden" name="action" value="reset_password">
            <label for="password_old">Old Password:</label>
            <input type="password" name="password_old">
            <label for="password_new">New Password:</label>
            <input type="password" name="password_new">
            <label for="password_conf">Confirm Password:</label>
            <input type="password" name="password_conf">
            <input type="submit" value="Save">
        </fieldset>
    </form>
</body>
</html>