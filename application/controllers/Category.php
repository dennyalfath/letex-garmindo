<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
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
        $this->load->model('category_m');
    }

    public function index()
    {
        $category = $this->category_m->get_all_category();
        $data = array(
            'title' => 'Category List',
            'category' => $category,
        );
        $this->load->view('templates/header', $data);
        $this->load->view('category/index');
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $data = array(
            'title' => 'Add Category',
        );

        $this->load->view('templates/header', $data);
        $this->load->view('category/add');
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('cat_name', 'Category Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Empty value is not allowed!</div>');
            redirect(base_url('category/add'));
        } else {
            $data = array(
                'cat_name' => $this->input->post('cat_name'),
            );

            if ($this->category_m->insert_category($data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data saved!</div>');
                redirect(base_url('category'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to save data!</div>');
                redirect(base_url('category/add'));
            }
        }
    }

    public function edit($id)
    {
        $data = array(
            'title' => 'Edit Data Perusahaan',
            'category' => $this->category_m->get_category_by_id($id)
        );
        $this->load->view('templates/header', $data);
        $this->load->view('category/edit');
        $this->load->view('templates/footer');
    }

    public function update($id)
    {
        $this->form_validation->set_rules('cat_name', 'Category Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Empty value is not allowed!</div>');
            redirect(base_url('category/edit/' . $id));
        } else {
            $data = array(
                'cat_name' => $this->input->post('cat_name'),
            );

            if ($this->category_m->update_category($id, $data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data updated!</div>');
                redirect(base_url('category'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to update data!</div>');
                redirect(base_url('category/edit/' . $id));
            }
        }
    }

    public function destroy($id)
    {
        if ($this->category_m->delete_category($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data deleted!</div>');
            redirect(base_url('category'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to delete data!</div>');
            redirect(base_url('category'));
        }
    }

    public function upload_logo()
    {
        $config['upload_path']          = './uploads/category-logo';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 3000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('category_logo')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('category/add', $error);
        } else {
            return $this->upload->data('file_name');
        }
    }
}
