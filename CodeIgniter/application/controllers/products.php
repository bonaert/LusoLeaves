<?php

class Products extends CI_CONTROLLER
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('products_model');
        $this->load->model('users_model');
        $this->lang->load('lusoleaves');
    }

    public function index()
    {
        $data['products'] = $this->products_model->get_products();

        $data['title'] = "LusoLeaves";
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');
        $data['companyType'] = $this->session->userdata('companyType');


        $this->load->view('products/index', $data);
    }

    public function create()
    {
        $data['title'] = "LusoLeaves";
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');
        if (!$data['is_logged_in'] || !$data['is_admin']) {
            redirect(site_url('products'));
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('prixunite', 'Prix Unité', 'required');
        $this->form_validation->set_rules('tpb', 'Tiges par bouquet', 'required|integer');
        $this->form_validation->set_rules('bpc', 'Bouquets par caisse', 'required|integer');

        if ($this->form_validation->run() === FALSE || !isset($_FILES) || !isset($_FILES['image'])) {
            $this->load->view('products/add', $data);
        } else {
            $this->products_model->add_product();
            redirect(site_url('products'));
        }
    }



    public function edit($id)
    {
        $data['product'] = $this->products_model->get_products($id);
        $data['title'] = "LusoLeaves";
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');

        if (!$data['is_logged_in'] || !$data['is_admin']) {
            redirect(site_url('products'));
        }


        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('prixunite', 'Prix Unité', 'required|is_numeric');
        $this->form_validation->set_rules('tpb', 'Tiges par bouquet', 'required|integer');
        $this->form_validation->set_rules('bpc', 'Bouquets par caisse', 'required|integer');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('products/edit', $data);
        } else {
            $this->products_model->update_product($id);
            redirect(site_url('products'));
        }
    }


    public function delete($id)
    {
        $data['title'] = "LusoLeaves";
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');

        if ($data['is_logged_in'] && $data['is_admin']) {
            $this->products_model->delete_product($id);
        }
        redirect(site_url('products'));
    }


}