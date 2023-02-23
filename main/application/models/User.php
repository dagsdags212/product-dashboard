<?php 
class User extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function get_user_info($user_email) {
        $user = $this->db->query('SELECT * FROM dashboard.users WHERE email = ?', $user_email)->row_array();
        $user_data = array(
            'id' => $user['id'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'created_at' => $user['created_at'],
            'is_admin' => boolval($user['is_admin'])
            );
        $this->session->set_userdata('user_info', $user_data);
    }

    public function is_admin($user_email) {
        return $this->db->query('SELECT is_admin FROM dashboard.users WHERE email = ?', $user_email)->row_array();
    }
 
    public function login($user_data) {
        $result =  $this->db->query('SELECT email, password FROM dashboard.users WHERE email = ?', $user_data['email'])->row_array();
        if(isset($result)) {
            $valid_credentials = (md5($user_data['password']) == $result['password'] && $user_data['email'] == $result['email']);
            if($valid_credentials) {
                echo 'log in success!';
                return TRUE;
            } else {
                echo 'invalid credentials!';
                return FALSE;
            }
        }
    }

    public function validate_info($user_data, $validation_type) {
        $this->load->library('form_validation');
        $this->form_validation->set_data($user_data);
        if($this->form_validation->run($validation_type)) {
            return TRUE;
        } 
        return FALSE;
    }

    public function add_user($user_data, $is_admin = FALSE) {
        if($is_admin) {
            $user_data['is_admin'] = 1;
        } else {
            $user_data['is_admin'] = 0;
        }
        $query = 'INSERT INTO dashboard.users (first_name, last_name, email, password, is_admin, created_at, updated_at) VALUES (?,?,?,?,?,NOW(),NOW())';
        $values = array($user_data['first_name'], $user_data['last_name'], $user_data['email'], md5($user_data['password']), $user_data['is_admin']);
        if($this->db->query($query, $values)) {
            return TRUE;
        }
        return FALSE;
    }

    public function edit_info($id, $user_info) {
        $query = 'UPDATE dashboard.users SET users.email = ?, users.first_name = ?, users.last_name = ?, users.updated_at = ? WHERE users.id = ?';
        $values = array($user_info['email'], $user_info['first_name'], $user_info['last_name'], date('Y-m-d H:i:s'), $id);
        if($this->db->query($query, $values)) {
            echo '<p class="success">User information has been updated!</p>';
            $this->get_user_info($user_info['email']);
            return TRUE;
        } else {
            echo '<p class="error">Cannot update user information</p>';
            return FALSE;
        }
    }

    public function reset_password($id, $user_info) {
        $user = $this->db->query('SELECT * FROM dashboard.users WHERE users.id = ?', $id)->row_array();
        if($user['password'] === $user_info['password_old']) {
            $query = 'UPDATE dashboard.users SET users.password = ?, users.updated_at = ? WHERE users.id = ?';
            $values = array($user_info['password_new'], date('Y-m-d H:i:s'), $id);
            if($this->db->query($query, $values)) {
                echo '<p class="success">Password has been reset!</p>';
                return TRUE;
            } else {
                echo '<p class="error">Cannot reset password</p>';
                return FALSE;
            }
        } else {
            echo '<p class="error">Old password is incorrect!</p>';
            return FALSE;
        }
    }

}
?>