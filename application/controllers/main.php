<?php

class Main extends CI_CONTROLLER
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->lang->load('lusoleaves');
    }

    public function index()
    {
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');
        $data['is_admin'] = $this->session->userdata('is_admin');

        $data['_external_js'][] = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCr8NrowWwR9foQuKE4s2jJlopGP0UbHgY&sensor=false';
        $data['_internal_js'][] = 'maps.js';
        //$data['_internal_css'][] = 'main.css';
        $data['content_view'] = 'index';
        $this->load->view('template', $data);
    }
}