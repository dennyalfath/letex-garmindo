<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') != '' && $this->session->userdata('role') == 'superadmin') {
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
            'title' => 'Super Admin',
            'total_orders' => $this->salesorder_m->count_all_so(),
            'oncutting' => $this->salesorder_m->count_oncutting_so(),
            'onsewing' => $this->salesorder_m->count_onsewing_so(),
            'onpacking' => $this->salesorder_m->count_onpacking_so(),
            'sent_out' => $this->salesorder_m->count_sent_out_so(),
            'cancelled' => $this->salesorder_m->count_cancelled_so()
        );

        $this->load->view('templates/header', $data);
        $this->load->view('superadmin/index');
        $this->load->view('templates/footer');
    }

    public function usermanage()
    {
        $data = array(
            'title' => 'Manajemen User',
            'userlist' => $this->users_m->get_all_users()
        );

        $this->load->view('templates/header', $data);
        $this->load->view('superadmin/userlist');
        $this->load->view('templates/footer');
    }

    public function edituser($id)
    {
        $user = $this->users_m->get_user_by_id($id);
        $data = array(
            'title' => 'Edit User',
            'user' => $user
        );

        $this->load->view('templates/header', $data);
        $this->load->view('superadmin/useredit');
        $this->load->view('templates/footer');
    }

    public function updateuser($id)
    {
        $data = array(
            'user_id' => $id,
            'role' => $this->input->post('role'),
            'block' => $this->input->post('block')
        );

        $response = $this->users_m->update_user($data);
        if (!$response->error) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $response->message . '</div>');
            redirect(base_url('superadmin/usermanage'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $response->message . '</div>');
            redirect(base_url('superadmin/edituser/' . $id));
        }
    }

    public function deleteuser($id)
    {
        $response = $this->users_m->delete_user($id);
        if (!$response->error) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $response->message . '</div>');
            redirect(base_url('superadmin/usermanage'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $response->message . '</div>');
            redirect(base_url('superadmin/usermanage'));
        }
    }
}
