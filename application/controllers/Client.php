<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
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
        $this->load->model('client_m');
        $this->load->model('company_m');
    }
    public function index()
    {
        $data = array(
            'title' => 'Daftar Client',
            'client' => $this->client_m->get_all_client()
        );
        $this->load->view('templates/header', $data);
        $this->load->view('client/index');
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $data = array(
            'title' => 'Tambah Client',
            'company' => $this->company_m->get_all_company()
        );

        $this->load->view('templates/header', $data);
        $this->load->view('client/add');
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('client_name', 'Nama Client', 'required');
        $this->form_validation->set_rules('client_contact', 'No. Telp', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak boleh ada data kosong!</div>');
            redirect(base_url('client/add'));
        } else {
            $data = array(
                'client_name' => $this->input->post('client_name'),
                'client_contact' => $this->input->post('client_contact'),
                'company_id' => $this->input->post('company')
            );

            if ($this->client_m->insert_client($data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                redirect(base_url('client'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
                redirect(base_url('client/add'));
            }
        }
    }

    public function edit($id)
    {
        $data = array(
            'title' => 'Edit Data Client',
            'client' => $this->client_m->get_client_by_id($id),
            'company' => $this->company_m->get_all_company()
        );
        $this->load->view('templates/header', $data);
        $this->load->view('client/edit');
        $this->load->view('templates/footer');
    }

    public function update($id)
    {
        $this->form_validation->set_rules('client_name', 'Nama Client', 'required');
        $this->form_validation->set_rules('client_contact', 'No. Telp', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak boleh ada data kosong!</div>');
            redirect(base_url('client/edit/' . $id));
        } else {
            $data = array(
                'client_name' => $this->input->post('client_name'),
                'client_contact' => $this->input->post('client_contact'),
                'company_id' => $this->input->post('company')
            );

            if ($this->client_m->update_client($id, $data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>');
                redirect(base_url('client'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal diubah!</div>');
                redirect(base_url('client/edit/' . $id));
            }
        }
    }

    public function destroy($id)
    {
        if ($this->client_m->delete_client($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
            redirect(base_url('client'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal dihapus!</div>');
            redirect(base_url('client'));
        }
    }
}
