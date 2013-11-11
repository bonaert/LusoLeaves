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

        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');
        $data['companyType'] = $this->session->userdata('companyType');

        $data['_external_css'][] = '//cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.3.4/css/semantic.min.css';
        $data['content_view'] = 'products/index';

        $this->load->view('template', $data);
    }

    public function create()
    {
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');
        if (!$data['is_logged_in'] || !$data['is_admin']) {
            redirect(site_url('products'));
        }

        $data['_external_css'][] = '//cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.3.4/css/semantic.min.css';
        $data['content_view'] = 'products/add';

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('prixFloriste', 'Prix Floriste', 'required|is_numeric');
        $this->form_validation->set_rules('prixGrossiste', 'Prix Grossiste', 'required|is_numeric');
        $this->form_validation->set_rules('tpb', 'Tiges par bouquet', 'required|integer');
        $this->form_validation->set_rules('bpc', 'Bouquets par caisse', 'required|integer');

        if ($this->form_validation->run() === FALSE || !isset($_FILES) || !isset($_FILES['image'])) {
            $this->load->view('template', $data);
        } else {
            $this->products_model->add_product();
            redirect(site_url('products'));
        }
    }


    public function edit($id)
    {
        $data['product'] = $this->products_model->get_products($id);
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');

        if (!$data['is_logged_in'] || !$data['is_admin']) {
            redirect(site_url('products'));
        }

        $data['_external_css'][] = '//cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.3.4/css/semantic.min.css';
        $data['content_view'] = 'products/edit';


        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('prixFloriste', 'Prix Floriste', 'required|is_numeric');
        $this->form_validation->set_rules('prixGrossiste', 'Prix Grossiste', 'required|is_numeric');
        $this->form_validation->set_rules('tpb', 'Tiges par bouquet', 'required|integer');
        $this->form_validation->set_rules('bpc', 'Bouquets par caisse', 'required|integer');
        $this->form_validation->set_rules('isAvailable', 'Is Available', 'required|integer');
        $this->form_validation->set_rules('availabilityDate', 'Availability date', '');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('template', $data);
        } else {
            $this->products_model->update_product($id);
            redirect(site_url('products'));
        }
    }


    public function delete($id)
    {
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');

        if ($data['is_logged_in'] && $data['is_admin']) {
            $this->products_model->delete_product($id);
        }
        redirect(site_url('products'));
    }


}