<?php 
class Product extends CI_Model {

    public function fetch_all() {
        return $this->db->query('SELECT * FROM products')->result_array();
    }

    public function get_product_by_id($product_id) {
        return $this->db->query('SELECT * FROM dashboard.products WHERE products.id = ?', $product_id)->row_array();
    }

    public function remove_product($product_id) {
        if($this->db->query('DELETE FROM dashboard.products WHERE products.id = ?', $product_id)) {
            echo '<p class="success">Product has been removed from the database!</p>';
            redirect('users/dashboard');
            return TRUE;
        }
        echo '<p class="error">Failed to remove product</p>';
        redirect('users/dashboard');
        return FALSE;
    }

    public function add_product($product) {
        $query = 'INSERT INTO dashboard.products (name, price, description, stock, sold, created_at, updated_at) VALUES (?,?,?,?,?,NOW(),NOW())';
        $values = array($product['product_name'], $product['product_price'], $product['product_description'], $product['inventory_count'], 0);
        if($this->db->query($query, $values)){
            echo '<p class="success">Product added to database!</p>';
            redirect('users/dashboard');
            return TRUE;
        }
        echo '<p class="error">Failed to add product to database</p>';
        redirect('products/new');
        return FALSE;
    }

    public function update_product($product_id, $product) {
        $query = 'UPDATE dashboard.products SET products.name = ?,  products.description = ?, products.price = ?, products.stock = ? WHERE products.id = ?';
        $values = array($product['product_name'], $product['product_description'], $product['product_price'], $product['inventory_count'], $product_id);
        if($this->db->query($query, $values)){
            echo '<p class="success">Product information has been updated!</p>';
            redirect('users/dashboard');
            return TRUE;
        }
        echo '<p class="error">Failed to update product information</p>';
        redirect('products/edit/'.$product_id);
        return FALSE;
    }
}
?>