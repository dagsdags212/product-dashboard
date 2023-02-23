<?php $this->load->view('partials/header'); ?>

    <button><a href="/users/dashboard">Return to Dashboard</a></button>
    <h2>Edit Product #<?= $product_id ?></h2>
    <form action="/products/update_product/<?= $product_id ?>" method="post">
        <label for="product_name">Name:</label>
        <input type="text" name="product_name" id="product_name">
        <label for="product_description">Description:</label>
        <textarea name="product_description" id="product_description"></textarea>
        <label for="product_price">Price:</label>
        <input type="text" name="product_price" id="product_price">
        <label for="inventory_count">Inventory Count:</label>
        <input type="number" name="inventory_count" id="inventory_count" min="1">
        <input type="submit" value="Save">
    </form>

<?php $this->load->view('partials/footer'); ?>