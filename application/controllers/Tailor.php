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
    }
    public function index()
    {
        $data = array(
            'title' => 'Tailor'
        );
        $this->load->view('templates/header', $data);
        $this->load->view('tailor/index');
        $this->load->view('templates/footer');
    }
}
