<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SalesOrder extends CI_Controller
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
        $this->load->model('product_m');
        $this->load->model('users_m');
        $this->load->model('salesorder_m');
    }

    public function index()
    {
        $data = array(
            'title' => 'Sales Order',
            'salesorder' => $this->salesorder_m->get_all_so()
        );

        $this->load->view('templates/header', $data);
        $this->load->view('salesorder/index');
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $data = array(
            'title' => 'Add Sales Order',
            'client' => $this->client_m->get_all_client()
        );

        $this->load->view('templates/header', $data);
        $this->load->view('salesorder/add');
        $this->load->view('templates/footer');
    }

    public function get_company_so()
    {
        $client = $this->input->post('client');
        $data = $this->salesorder_m->get_company_by_clid($client);
        echo json_encode($data);
    }

    public function store()
    {
        $this->form_validation->set_rules('so_number', 'SO Number', 'required');
        $this->form_validation->set_rules('client', 'Client', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>');
            redirect(base_url('salesorder/add'));
        } else {
            $client_id = $this->input->post('client');
            $data = array(
                'so_number' => $this->input->post('so_number'),
                'client_id' => $client_id,
                'so_description' => $this->input->post('description'),
                'so_date_order' => date('Y-m-d')
            );

            //Get Selected Company
            $company_id = intval($this->input->post('company'));

            //Set new value for Company SO Number
            $so_number = intval($this->input->post('int_so_number'));
            $data_company = array(
                'so_number' => $so_number
            );

            if ($this->salesorder_m->insert_sales_order($data)) {
                //Update client SO Number
                $this->company_m->update_company_data($company_id, $data_company);

                //Message and Redirect
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data saved.</div>');
                redirect(base_url('salesorder'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to save data.</div>');
                redirect(base_url('salesorder/add'));
            }
        }
    }

    public function edit($id)
    {
        $salesorder = $this->salesorder_m->get_so_by_id($id);
        $data = array(
            'title' => 'Edit Sales Order',
            'salesorder' => $salesorder
        );

        $this->load->view('templates/header', $data);
        $this->load->view('salesorder/edit');
        $this->load->view('templates/footer');
    }

    public function update($id)
    {
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>');
            redirect(base_url('salesorder/add'));
        } else {
            $client_id = $this->input->post('client');
            $data = array(
                'so_description' => $this->input->post('description'),
                'so_status' => $this->input->post('status')
            );

            if ($this->salesorder_m->update_sales_order($id, $data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data updated.</div>');
                redirect(base_url('salesorder'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to update data.</div>');
                redirect(base_url('salesorder/edit/' . $id));
            }
        }
    }

    public function show_detail($so_id)
    {
        $so = $this->salesorder_m->get_so_by_id($so_id);
        $data = array(
            'title' => 'Sales Order Detail',
            'so_id' => $so->so_id,
            'so_detail' => $this->salesorder_m->get_all_so_details($so->so_number)
        );

        $this->load->view('templates/header', $data);
        $this->load->view('salesorder/show_detail');
        $this->load->view('templates/footer');
    }

    public function add_detail($so_id)
    {
        $salesorder = $this->salesorder_m->get_so_by_id($so_id);

        $data = array(
            'title' => 'Add Sales Order Detail',
            'product' => $this->product_m->get_products_by_clid($salesorder->client_id),
            'salesorder' => $this->salesorder_m->get_so_num_by_id($so_id),
        );

        $this->load->view('templates/header', $data);
        $this->load->view('salesorder/add_detail');
        $this->load->view('templates/footer');
    }

    public function store_detail()
    {
        $sod_so_number = $this->input->post('sod_so_number');
        $sod_product = $this->input->post('sod_product');
        $sod_user = $this->session->userdata('user_id');
        $sod_qty = $this->input->post('sod_qty');
        $sod_remark_size = $this->input->post('sod_remark_size');
        $sod_desc = $this->input->post('sod_desc');
        $sod_status = $this->input->post('sod_status');
        $sod_price = $this->input->post('sod_price');

        $data = array();
        $i = 0;
        $so_id = $this->input->post('so_id');

        foreach ($sod_so_number as $so_num) {
            array_push($data, array(
                'so_number' => $so_num,
                'pr_id' => $sod_product[$i],
                'user_id' => $sod_user,
                'qty' => $sod_qty[$i],
                'price' => $sod_price[$i],
                'remark_size' => $sod_remark_size[$i],
                'sod_description' => $sod_desc[$i],
                'sod_status' => $sod_status[$i]
            ));

            $i++;
        }

        if ($this->salesorder_m->insert_sales_order_detail($data)) {
            $this->salesorder_m->update_sales_order_status($so_id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data saved.</div>');
            redirect(base_url('salesorder'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to save data.</div>');
            redirect(base_url('salesorder'));
        }
    }

    public function update_detail_status($id)
    {
        $data = array(
            'sod_status' => $this->input->get('status')
        );
        $so_id = $this->input->get('so_id');

        if ($this->salesorder_m->update_sales_order_detail($id, $data)) {
            $this->salesorder_m->update_sales_order_status($so_id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Status updated.</div>');
            redirect(base_url('/salesorder/show_detail/' . $so_id));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to update status.</div>');
            redirect(base_url('/salesorder/show_detail/' . $so_id));
        }
    }
}
