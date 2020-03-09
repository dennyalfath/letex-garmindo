<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
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
        $this->load->model('product_m');
    }
    public function index()
    {
        $data = array(
            'title' => 'Daftar Produk',
            'product' => $this->product_m->get_all_products()
        );
        $this->load->view('templates/header', $data);
        $this->load->view('product/index');
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $data = array(
            'title' => 'Tambah Produk'
        );

        $this->load->view('templates/header', $data);
        $this->load->view('product/add');
        $this->load->view('templates/footer');
    }

    // public function store()
    // {
    //     $this->form_validation->set_rules('company_name', 'Nama Perusahaan', 'required');
    //     $this->form_validation->set_rules('company_contact', 'No. Telp', 'required');
    //     $this->form_validation->set_rules('company_address', 'Alamat', 'required');
    //     $this->form_validation->set_rules('company_status', 'Status', 'required');

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak boleh ada data kosong!</div>');
    //         redirect(base_url('company/add'));
    //     } else {
    //         $data = array(
    //             'company_name' => $this->input->post('company_name'),
    //             'company_contact' => $this->input->post('company_contact'),
    //             'company_address' => $this->input->post('company_address'),
    //             'company_status' => $this->input->post('company_status')
    //         );

    //         if ($this->company_m->insert_company($data)) {
    //             $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
    //             redirect(base_url('company'));
    //         } else {
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
    //             redirect(base_url('company/add'));
    //         }
    //     }
    // }

    // public function edit($id)
    // {
    //     $data = array(
    //         'title' => 'Edit Data Perusahaan',
    //         'company' => $this->company_m->get_company_by_id($id)
    //     );
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('company/edit');
    //     $this->load->view('templates/footer');
    // }

    // public function update($id)
    // {
    //     $this->form_validation->set_rules('company_name', 'Company Name', 'required');
    //     $this->form_validation->set_rules('company_contact', 'Contact', 'required');
    //     $this->form_validation->set_rules('company_address', 'Address', 'required');
    //     $this->form_validation->set_rules('company_status', 'Status', 'required');

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak boleh ada data kosong!</div>');
    //         redirect(base_url('company/edit/' . $id));
    //     } else {
    //         $data = array(
    //             'company_name' => $this->input->post('company_name'),
    //             'company_contact' => $this->input->post('company_contact'),
    //             'company_address' => $this->input->post('company_address'),
    //             'company_status' => $this->input->post('company_status')
    //         );

    //         if ($this->company_m->update_company($id, $data)) {
    //             $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah!</div>');
    //             redirect(base_url('company'));
    //         } else {
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal diubah!</div>');
    //             redirect(base_url('company/edit/' . $id));
    //         }
    //     }
    // }

    // public function destroy($id)
    // {
    //     if ($this->company_m->delete_company($id)) {
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
    //         redirect(base_url('company'));
    //     } else {
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal dihapus!</div>');
    //         redirect(base_url('company'));
    //     }
    // }
}
