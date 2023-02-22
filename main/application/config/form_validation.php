<?php 
$config = array(
    // registration validation
    'register' => array(
        array(
            'field' => 'email',
            'label' => 'Email address',
            'rules' => 'trim|required|valid_email|is_unique[users.email]'
            ),
        array(
            'field' => 'first_name',
            'label' => 'First name',
            'rules' => 'trim|required|min_length[2]|alpha_numeric'
            ),
        array(
            'field' => 'last_name',
            'label' => 'Last name',
            'rules' => 'trim|required|min_length[2]|alpha'
            ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
            ),
        array(
            'field' => 'password_conf',
            'label' => 'Password confirmation',
            'rules' => 'required|matches[password]'
            )
        ),
    // update information validation
    'update_info' => array(
            array(
                'field' => 'email',
                'label' => 'Email address',
                'rules' => 'required|valid_email|is_unique[users.email]'
            ),
            array(
                'field' => 'first_name',
                'label' => 'First name',
                'rules' => 'required|min_length[2]|alpha_numeric'
            ),
            array(
                'field' => 'last_name',
                'label' => 'Last name',
                'rules' => 'required|min_length[2]|alpha'
            )
        ),
    // reset password validation
    'reset_password' => array(
            array(
                'field' => 'password_old',
                'label' => 'Old password',
                'rules' => 'required'
            ),
            array(
                'field' => 'password_new',
                'label' => 'New password',
                'rules' => 'required'
            ),
            array(
                'field' => 'password_conf',
                'label' => 'Password confirmation',
                'rules' => 'required|matches[password_new]'
            )
    )
);
?>