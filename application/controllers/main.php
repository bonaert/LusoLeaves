<?php

class Main extends CI_CONTROLLER
{
    public function __construct()
    {
        parent::__construct();
        use_ssl(false);
        $this->load->model('users_model');
        $this->lang->load('lusoleaves');
    }

    public function index()
    {
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');
        $data['is_admin'] = $this->session->userdata('is_admin');
        $this->load->view('index', $data);
    }
}