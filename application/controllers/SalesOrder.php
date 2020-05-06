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
}
