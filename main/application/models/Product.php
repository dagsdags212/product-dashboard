<?php 
class Product extends CI_Model {
    public function fetch_all() {
        return $this->db->query('SELECT * FROM products')->result_array();
    }
}
?>