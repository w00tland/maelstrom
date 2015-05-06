<?php

class VerifyLogin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user', '', true);
    }

    public function index()
    {
        $data['title'] = 'Login';

        $this->load->helper('security');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('login', $data);
            $this->load->view('templates/admin_footer', $data);
        } else {
            redirect('admin', 'refresh');
        }
    }

    function check_database($password)
    {
        $username = $this->input->post('username');
        $result   = $this->user->login($username, $password);

        if ($result) {
            foreach($result as $row) {
                $sess_array = array(
                    'id' => $row->id,
                    'username' => $row->username
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return true;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }
}