<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information</title>
    <link rel="stylesheet" href="/assets/css/styles.css" />
</head>
<body>
    <header>
        <p>V88 Merchandise</p>
<?php if(!is_null($this->session->userdata('logged_in'))) { ?>
        <a href="/users/logout">Log out</a>    
        <a href="/users/dashboard" id="dashboard_link">Dashboard</a>
        <a href="/users/profile" id="profile_link">Profile</a>
<?php } else { ?>
        <a href="/users/login">Log in</a>    
<?php } ?>
    </header>