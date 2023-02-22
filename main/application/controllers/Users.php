<?php 
class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User');
        $this->load->model('Product');
        $this->load->model('Review');
        // $this->output->enable_profiler(TRUE);
    }

    public function index() {
        if($this->session->userdata('logged_in')) {
            redirect('users/dashboard');
        } else {
            $this->load->view('login');
        }
    }

    public function register() {
        $this->load->view('register');
    }

    public function login() {
        $user_data = $this->input->post();
        $logged_in = $this->User->login($user_data);
        if($logged_in) {
            $this->User->get_user_info($user_data['email']);
            $this->session->set_userdata('logged_in', TRUE);
            redirect('users/dashboard');
        } else {
            echo '<p class="error">Invalid credentials</p>';
            redirect('users/index');
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('users/login');
    }

    public function add_user() {
        $user_data = $this->input->post();
        if($this->User->validate_info($user_data, 'register')){
            $this->User->add_user($user_data);
            $this->User->get_user_info($user_data['email']);
            $this->session->set_userdata('logged_in', TRUE);
            redirect('users/dashboard');
        } else {
            echo "Unable to register ${$user_data['first_name']} ${$user_data['last_name']}";
            redirect('users/register');
        }

    }

    public function dashboard() {  
        if($this->session->userdata('logged_in')) {
            $product_data['products'] = $this->Product->fetch_all();
            $this->load->view('dashboard', $product_data);
        }
    }

    public function profile() {
        if($this->session->userdata('logged_in')) {
            $user_data['user_info'] = $this->session->userdata('user_info');
            $this->load->view('profile', $user_data);
        }
    }

    public function update_info() {
        $user_data = $this->input->post();
        //update user information
        if($user_data['action'] == 'edit_info') {
            if($this->User->validate_info($user_data, 'update_info')) {
                $this->User->edit_info($_SESSION['user_info']['id'], $user_data);
            }
        // reset user password
        } else if ($user_data['action'] == 'reset_password') {
            if($this->User->validate_info($user_data, 'reset_password')) {
                $this->User->reset_password($_SESSION['user_info']['id'], $user_data);
            }
        }
        redirect('users/profile');
    }
}

?>