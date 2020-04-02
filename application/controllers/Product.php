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
        $this->load->model('client_m');
        $this->load->model('category_m');
    }
    public function index()
    {
        $data = array(
            'title' => 'Product List',
            'product' => $this->product_m->get_all_products()
        );
        $this->load->view('templates/header', $data);
        $this->load->view('product/index');
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $data = array(
            'title' => 'Add Product',
            'client' => $this->client_m->get_client_list(),
            'category' => $this->category_m->get_all_category()
        );

        $this->load->view('templates/header', $data);
        $this->load->view('product/add');
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('pr_name', 'Product Name', 'required');
        $this->form_validation->set_rules('pr_client', 'Client', 'required');
        $this->form_validation->set_rules('pr_category', 'Category', 'required');
        $this->form_validation->set_rules('sell_price', 'Sell Price', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Empty value is not allowed!</div>');
            redirect(base_url('product/add'));
        } else {
            $data = array(
                'client_id' => $this->input->post('pr_client'),
                'cat_id' => $this->input->post('pr_category'),
                'pr_name' => $this->input->post('pr_name'),
                'style' => $this->input->post('style'),
                'sell_price' => $this->input->post('sell_price'),
                'pr_description' => $this->input->post('desc'),
                'pr_picture' => $this->upload_image()
            );

            if ($this->product_m->insert_product($data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data saved!</div>');
                redirect(base_url('product'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to save data!</div>');
                redirect(base_url('product/add'));
            }
        }
    }

    public function upload_image($pr_id = null)
    {
        $config['upload_path']          = './uploads/product-image';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['max_size']             = 3000;
        $config['overwrite']            = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('pr_image')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('company/add', $error);
        } else {
            return $this->upload->data('file_name');
        }
    }

    public function edit($id)
    {
        $product = $this->product_m->get_product_by_id($id);
        $data = array(
            'title' => 'Modify Product Data',
            'product' => $product,
            'client' => $this->client_m->get_client_list(),
            'category' => $this->category_m->get_all_category(),
            'clientpil' => $product->client_id,
            'categorypil' => $product->cat_id
        );
        $this->load->view('templates/header', $data);
        $this->load->view('product/edit');
        $this->load->view('templates/footer');
    }

    public function update($id)
    {
        $this->form_validation->set_rules('pr_name', 'Product Name', 'required');
        $this->form_validation->set_rules('pr_client', 'Client', 'required');
        $this->form_validation->set_rules('pr_category', 'Category', 'required');
        $this->form_validation->set_rules('sell_price', 'Sell Price', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Empty value is not allowed!</div>');
            redirect(base_url('product/edit/' . $id));
        } else {
            $pr_picture = $this->upload_image($id);
            if ($pr_picture) {
                $data = array(
                    'client_id' => $this->input->post('pr_client'),
                    'cat_id' => $this->input->post('pr_category'),
                    'pr_name' => $this->input->post('pr_name'),
                    'style' => $this->input->post('style'),
                    'sell_price' => $this->input->post('sell_price'),
                    'pr_description' => $this->input->post('desc'),
                    'pr_picture' => $pr_picture
                );
            } else {
                $data = array(
                    'client_id' => $this->input->post('pr_client'),
                    'cat_id' => $this->input->post('pr_category'),
                    'pr_name' => $this->input->post('pr_name'),
                    'style' => $this->input->post('style'),
                    'sell_price' => $this->input->post('sell_price'),
                    'pr_description' => $this->input->post('desc')
                );
            }

            if ($this->product_m->update_product($id, $data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data updated!</div>');
                redirect(base_url('product'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to update data!</div>');
                redirect(base_url('product/edit/' . $id));
            }
        }
    }

    public function destroy($id)
    {
        if ($this->product_m->delete_product($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data deleted!</div>');
            redirect(base_url('product'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to delete data!</div>');
            redirect(base_url('product'));
        }
    }
}
