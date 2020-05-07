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

    public function getClient()
    {
        $client = $this->input->post('client');
        $data = $this->salesorder_m->get_client_by_clid($client);
        echo json_encode($data);
    }

    public function store()
    {
        $this->form_validation->set_rules('so_number', 'SO Number', 'required');
        $this->form_validation->set_rules('client', 'Client', 'required');
        $this->form_validation->set_rules('total_amount', 'Total Amount', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>');
            redirect(base_url('salesorder/add'));
        } else {
            $client_id = $this->input->post('client');
            $data = array(
                'so_number' => intval($this->input->post('so_number')),
                'client_id' => $client_id,
                'so_description' => $this->input->post('description'),
                'so_date_order' => date('Y-m-d'),
                'so_total_amount' => $this->input->post('total_amount'),
                'so_status' => $this->input->post('status')
            );

            //Set new value for Client SO Number
            $so_number = intval($this->input->post('so_number'));
            $data_client = array(
                'so_number' => $so_number
            );

            if ($this->salesorder_m->insert_sales_order($data)) {
                //Update client SO Number
                $this->client_m->update_client($client_id, $data_client);

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
        $this->form_validation->set_rules('total_amount', 'Total Amount', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . validation_errors() . '</div>');
            redirect(base_url('salesorder/add'));
        } else {
            $client_id = $this->input->post('client');
            $data = array(
                'so_description' => $this->input->post('description'),
                'so_total_amount' => $this->input->post('total_amount'),
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
}
