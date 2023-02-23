<?php 
class Review extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->create_reviews_view();
        $this->create_comments_view();
    }

    // create a view by joining the reviews, comments, and users tables
    public function create_reviews_view() {
        $query = 'CREATE OR REPLACE VIEW reviews_view AS
                    SELECT reviews.product_id AS product_id, users.id AS user_id, users.first_name, users.last_name, 
                    reviews.id AS review_id, reviews.content AS review, reviews.created_at AS review_date
                    FROM dashboard.users
                        RIGHT JOIN dashboard.reviews ON users.id = reviews.user_id
                    ORDER BY review_date ASC';
        $this->db->query($query);
    }

    public function create_comments_view() {
        $query = 'CREATE OR REPLACE VIEW comments_view AS
                    SELECT reviews.id AS review_id, comments.id AS comment_id, reviews.product_id AS product_id, first_name, last_name, 
                    comments.content AS comment, comments.created_at AS comment_date
                    FROM dashboard.comments
                        LEFT JOIN dashboard.users ON comments.user_id = users.id
                        LEFT JOIN dashboard.reviews ON comments.review_id = reviews.id
                    ORDER BY comment_date ASC';
        $this->db->query($query);
    }

    public function get_all_reviews() {
        return $this->db->query('SELECT * FROM dashboard.reviews ORDER BY reviews.created_at DESC')->result_array();
    }

    public function get_reviews_by_product_id($product_id) {
        return $this->db->query('SELECT DISTINCT reviews_view.review_id, reviews_view.first_name, reviews_view.last_name, reviews_view.review, reviews_view.review_date FROM dashboard.reviews_view WHERE reviews_view.product_id = ?', $product_id)->result_array();
    }

    public function get_comments_by_product_id($product_id) {
        return $this->db->query('SELECT DISTINCT comments_view.review_id, comments_view.comment_id, comments_view.first_name, comments_view.last_name, comments_view.comment, comments_view.comment_date FROM dashboard.comments_view WHERE comments_view.product_id = ?', $product_id)->result_array();
    }

    public function post_review($review) {
        $query = 'INSERT INTO dashboard.reviews (reviews.user_id, reviews.product_id, reviews.content, reviews.created_at, reviews.updated_at) VALUES (?,?,?,NOW(),NOW())';
        $values = array($review['user_id'], $review['product_id'], $review['content']);
        if($this->db->query($query, $values)) {
            echo '<p class="success">Review posted!</p>';
            redirect('/products/show/'.$review['product_id']);
            return TRUE;
        }
        echo '<p class="error">Failed to post review</p>';
        redirect('/products/show/'.$review['product_id']);
        return FALSE;
    }

    public function post_comment($comment) {
        $query = 'INSERT INTO dashboard.comments (comments.review_id, comments.user_id, comments.content, comments.created_at, comments.updated_at) VALUES (?,?,?,NOW(),NOW())';
        $values = array($comment['review_id'], $comment['user_id'], $comment['content']);
        if($this->db->query($query, $values)) {
            echo '<p class="success">comment posted!</p>';
            redirect('/products/show/'.$comment['product_id']);
            return TRUE;
        }
        echo '<p class="error">Failed to post comment</p>';
        redirect('/products/show/'.$comment['product_id']);
        return FALSE;
    }
}
?>