<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Packing extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') != '' && $this->session->userdata('role') == 'packing') {
        } else {
            show_404();
        }

        $this->load->library('form_validation');
        $this->load->model('users_m');
        $this->load->model('salesorder_m');
    }
    public function index()
    {
        $data = array(
            'title' => 'Packing',
            'total_orders' => $this->salesorder_m->count_all_so(),
            'onpacking' => $this->salesorder_m->count_onpacking_so(),
            'sent_out' => $this->salesorder_m->count_sent_out_so(),
            'cancelled' => $this->salesorder_m->count_cancelled_so()
        );
        $this->load->view('templates/header', $data);
        $this->load->view('packing/index');
        $this->load->view('templates/footer');
    }
}
