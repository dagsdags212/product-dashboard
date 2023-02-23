<?php 
class Products extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product');
        $this->load->model('Review');
        // $this->output->enable_profiler(TRUE);
    }

    public function new() {
        $this->load->view('products/add');
    }

    public function show($product_id) {
        $view_data['product'] = $this->Product->get_product_by_id($product_id);
        $view_data['reviews'] = $this->Review->get_reviews_by_product_id($product_id);
        $view_data['comments'] = $this->Review->get_comments_by_product_id($product_id);
        $this->load->view('products/show', $view_data);
    }

    public function edit() {
        $uri = $this->uri->segment_array();
        $view_data['product_id'] = (int) end($uri);
        $this->load->view('products/edit', $view_data);
    }

    public function add_product() {
        $product = $this->input->post();
        $this->Product->add_product($product);
    }

    public function remove_product($product_id) {
        $this->Product->remove_product($product_id);
    }

    public function update_product($product_id) {
        $product = $this->input->post();
        $this->Product->update_product($product_id, $product);
    }

    public function post_review() {
        $review_data = $this->input->post();
        $user_data = $this->session->userdata('user_info');
        $review = array(
            'user_id' => $user_data['id'],
            'product_id' => $review_data['product_id'],
            'content' => $review_data['product_review']
        );
        $this->Review->post_review($review);
    }

    public function post_comment() {
        $comment_data = $this->input->post();
        $user_data = $this->session->userdata('user_info');
        $comment = array(
                'review_id' => $comment_data['review_id'],
                'product_id' => $comment_data['product_id'],
                'user_id' => $user_data['id'],
                'content' => $comment_data['comment']
            );
            // var_dump($comment);
        $this->Review->post_comment($comment);
    }
    
}
?>