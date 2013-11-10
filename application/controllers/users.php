<?php

class Users extends CI_CONTROLLER
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->lang->load('lusoleaves');
        use_ssl();
    }

    public function index()
    {
        $data['users'] = $this->users_model->get_users();
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');
        $data['companyType'] = $this->session->userdata('companyType');

        if (!$data['is_logged_in'] || !$data['is_admin']) {
            redirect(site_url('products'));
        }

        $data['_internal_css'] = ['main.css', 'table.css', 'product.css'];
        $data['_external_css'] = ['//cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.3.4/css/semantic.min.css'];
        $data['content_view'] = 'user/index';

        $this->load->view('template', $data);
    }

    public function register()
    {
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['_internal_css'] = ['form.css', 'main.css'];
        $data['_internal_js'] = ['sha512.js', 'forms.js'];
        $data['content_view'] = 'user/register';

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'required|min_length[4]|max_length[80]');
        $this->form_validation->set_rules('hashedPassword', 'Password', 'required|exact_length[128]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[User.email]');
        $this->form_validation->set_rules('companyName', 'Company Name', 'required|max_length[155]');
        $this->form_validation->set_rules('phoneNumber', 'Phone Number', 'required|integer');
        $this->form_validation->set_rules('contribuinteNumber', 'Contribuinte Number', 'required|integer|max_length[13]');
        $this->form_validation->set_rules('address', 'Address', 'required|min_length[4]|max_length[512]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('template', $data);
        } else {
            $this->users_model->add_user();
            $data = array(
                'is_logged_in' => true,
                'id_admin' => false,
                'companyType' => 'unknown'
            );
            $this->session->set_userdata($data);
            redirect(site_url('main'));
        }
    }

    public function login()
    {
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['_internal_css'] = ['form.css', 'main.css'];
        $data['_internal_js'] = ['sha512.js', 'forms.js'];
        $data['content_view'] = 'user/login';

        if ($data['is_logged_in']) {
            redirect('products');
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('hashedPassword', 'Password', 'required|exact_length[128]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|callback_is_email_used');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('template', $data);
            return;
        }

        $email = $this->input->post('email');
        $hashedPassword = $this->input->post('hashedPassword');
        if (!$this->users_model->is_correct_credentials($email, $hashedPassword)) {
            $this->load->view('template', $data);
            return;
        }

        $is_admin = $this->users_model->is_admin($email);
        $companyType = $this->users_model->get_company_type($email);
        $data = array(
            'is_logged_in' => true,
            'is_admin' => $is_admin,
            'companyType' => $companyType
        );
        $this->session->set_userdata($data);
        redirect(site_url('main'));
    }

    public function logout()
    {
        $this->session->unset_userdata('is_logged_in');
        $this->session->unset_userdata('is_admin');
        $this->session->unset_userdata('email');
        redirect(site_url('main'));
    }

    public function edit($id)
    {
        $data['user'] = $this->users_model->get_users($id);
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['_internal_css'] = ['main.css'];
        $data['_external_css'] = ['//cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.3.4/css/semantic.min.css'];
        $data['content_view'] = 'user/edit';

        if (!$data['is_logged_in'] || !$data['is_admin']) {
            redirect(site_url('products'));
        }

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('companyType', 'Company Type', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('template', $data);
        } else {
            $this->users_model->update_company_type($id);
            redirect(site_url('users/index'));
        }
    }


    public function is_email_used($email)
    {
        $this->load->library('form_validation');
        $is_email_used = $this->users_model->is_email_used($email);

        if ($is_email_used) {
            return true;
        } else {
            $this->form_validation->set_message('is_email_used', 'Wrong credentials.');
            return false;
        }
    }


    public function delete($id)
    {
        $data['is_admin'] = $this->session->userdata('is_admin');
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');

        if ($data['is_logged_in'] && $data['is_admin']) {
            $this->users_model->delete_user($id);
        }
        redirect(site_url('products'));
    }
}