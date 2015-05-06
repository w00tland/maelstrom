<?php

class Admin extends CI_Controller
{

    public function view($page = 'home')
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];

            if (!file_exists(APPPATH . 'views/admin/' . $page . '.php')) {
                show_404($page);
            }

            $data['title'] = ucfirst($page);

            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_menu', $data);
            $this->load->view('admin/' . $page, $data);
            $this->load->view('templates/admin_footer', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function logout()
    {
        if($this->session->userdata('logged_in')) {
            $this->session->unset_userdata('logged_in');
            session_destroy();
        }

        redirect('login', 'refresh');
    }
}