
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Dashboard - User</title>
    <link rel="stylesheet" href="/assets/css/dashboard.css">
</head>
<body>
    <header>
        <p>V88 Merchandise</p>
<?php if($this->session->userdata('logged_in')) { ?>
        <a href="/users/logout">Log out</a>    
<?php } else { ?>
        <a href="/users/register" id="register_link">Register</a>   
<?php } ?>
        <a href="/users/dashboard" id="dashboard_link">Dashboard</a>
        <a href="/users/profile" id="profile_link">Profile</a>
    </header>
    <h1>All Products</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Inventory Count</th>
            <th>Quantity Sold</th>
<?php if($this->session->userdata('user_info')['is_admin']) { ?>
            <th>Action</th>
<?php } ?>
        </tr>
<?php foreach($products as $product) { ?>
        <tr>
            <td><?= $product['id'] ?></td>
            <td><a href=""><?= $product['name'] ?></a></td>
            <td><?= $product['stock'] ?></td>
            <td><?= $product['sold'] ?></td>
<?php if($this->session->userdata('user_info')['is_admin']) { ?>
            <td>
                <a href="/users/edit_product">edit</a>
                <a href="/users/remove_product">remove</a>
            </td>
<?php } ?>
        </tr>
<?php } ?>
    </table>
</body>
</html>