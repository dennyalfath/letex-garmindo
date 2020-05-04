<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') != '' && $this->session->userdata('role') == 'superadmin') {
        } else if ($this->session->userdata('username') != '' && $this->session->userdata('role') == 'manager') {
        } else if ($this->session->userdata('username') != '' && $this->session->userdata('role') == 'admin') {
        } else {
            show_404();
        }
        $this->load->library('form_validation');
        $this->load->model('company_m');
        $this->load->model('client_m');
    }

    public function index()
    {
        $company = $this->company_m->get_all_company();
        $client = array();
        foreach ($company as $cp) {
            $client[$cp->company_id] = $this->client_m->get_client_by_cpid($cp->company_id);
        }

        $data = array(
            'title' => 'Company List',
            'company' => $company,
            'client' => $client
        );
        $this->load->view('templates/header', $data);
        $this->load->view('company/index');
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $data = array(
            'title' => 'Add Company',
        );

        $this->load->view('templates/header', $data);
        $this->load->view('company/add');
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('company_name', 'Company Name', 'required');
        $this->form_validation->set_rules('company_code', 'Company Code', 'required');
        $this->form_validation->set_rules('company_contact', 'Company Contact', 'required');
        $this->form_validation->set_rules('company_address', 'Company Address', 'required');
        $this->form_validation->set_rules('so_number', 'SO Number', 'required');
        $this->form_validation->set_rules('company_status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Empty value is not allowed!</div>');
            redirect(base_url('company/add'));
        } else {
            $data = array(
                'company_name' => $this->input->post('company_name'),
                'company_code' => $this->input->post('company_code'),
                'company_contact' => $this->input->post('company_contact'),
                'company_address' => $this->input->post('company_address'),
                'so_number' => $this->input->post('so_number'),
                'company_status' => $this->input->post('company_status'),
                'company_logo' => $this->upload_logo()
            );

            $response = $this->company_m->insert_company($data);

            if (!$response->error) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $response->message . '</div>');
                redirect(base_url('company'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $response->message . '</div>');
                redirect(base_url('company/add'));
            }
        }
    }

    public function edit($id)
    {
        $data = array(
            'title' => 'Edit Data Perusahaan',
            'company' => $this->company_m->get_company_by_id($id)
        );
        $this->load->view('templates/header', $data);
        $this->load->view('company/edit');
        $this->load->view('templates/footer');
    }

    public function update($id)
    {
        $this->form_validation->set_rules('company_name', 'Company Name', 'required');
        $this->form_validation->set_rules('company_code', 'Company Code', 'required');
        $this->form_validation->set_rules('company_contact', 'Contact', 'required');
        $this->form_validation->set_rules('company_address', 'Address', 'required');
        $this->form_validation->set_rules('so_number', 'SO Number', 'required');
        $this->form_validation->set_rules('company_status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Empty value is not allowed!</div>');
            redirect(base_url('company/edit/' . $id));
        } else {
            $company_logo = $this->upload_logo();
            if ($company_logo) {
                $data = array(
                    'company_id' => $id,
                    'company_name' => $this->input->post('company_name'),
                    'company_code' => $this->input->post('company_code'),
                    'company_contact' => $this->input->post('company_contact'),
                    'company_address' => $this->input->post('company_address'),
                    'so_number' => $this->input->post('so_number'),
                    'company_status' => $this->input->post('company_status'),
                    'company_logo' => $company_logo
                );
            } else {
                $data = array(
                    'company_id' => $id,
                    'company_name' => $this->input->post('company_name'),
                    'company_code' => $this->input->post('company_code'),
                    'company_contact' => $this->input->post('company_contact'),
                    'company_address' => $this->input->post('company_address'),
                    'so_number' => $this->input->post('so_number'),
                    'company_status' => $this->input->post('company_status'),
                    'company_logo' => ''
                );
            }
            $response = $this->company_m->update_company($data);
            if (!$response->error) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $response->message . '</div>');
                redirect(base_url('company'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $response->message . '</div>');
                redirect(base_url('company/edit/' . $id));
            }
        }
    }

    public function destroy($id)
    {
        $response = $this->company_m->delete_company($data);
        if (!$response->error) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $response->message . '</div>');
            redirect(base_url('company'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $response->message . '</div>');
            redirect(base_url('company'));
        }
    }

    public function upload_logo()
    {
        $config['upload_path']          = './uploads/company-logo';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 3000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('company_logo')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('company/add', $error);
        } else {
            return $this->upload->data('file_name');
        }
    }
}
