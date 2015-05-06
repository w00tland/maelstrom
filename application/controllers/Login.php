<?php

class Login extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Login';

        $this->load->helper(array('form'));

        $this->load->view('templates/admin_header', $data);
        $this->load->view('login', $data);
        $this->load->view('templates/admin_footer', $data);
    }
}