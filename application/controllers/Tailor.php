<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tailor extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') != '' && $this->session->userdata('role') == 'tailor') {
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
            'title' => 'Tailor',
            'total_orders' => $this->salesorder_m->count_all_so(),
            'onsewing' => $this->salesorder_m->count_onsewing_so(),
            'cancelled' => $this->salesorder_m->count_cancelled_so()
        );
        $this->load->view('templates/header', $data);
        $this->load->view('tailor/index');
        $this->load->view('templates/footer');
    }
}
