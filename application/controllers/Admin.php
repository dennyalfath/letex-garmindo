<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') != '' && $this->session->userdata('role') == 'admin') {
        } else {
            show_404();
        }

        $this->load->library('form_validation');
        $this->load->model('users_m');
    }
    public function index()
    {
        $data = array(
            'title' => 'Admin'
        );
        $this->load->view('templates/header', $data);
        $this->load->view('admin/index');
        $this->load->view('templates/footer');
    }
}
