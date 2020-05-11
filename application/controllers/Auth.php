<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('users_m');
    }
    public function index()
    {
        $this->load->view('auth/login');
    }

    public function login()
    {
        // Melakukan validasi input username dan password
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required',
            array('required' => 'Username harus diisi')
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required',
            array('required' => 'Password harus diisi')
        );

        // Jika validasi input username dan password bernilai false maka user/admin diminta melakukan input ulang
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
            // Menampilkan halaman utama login
        } else {
            // Input username dan password dengan fungsi POST 
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));

            $data = $this->users_m->get_by_login_data($username, $password);
            if ($data->user_id) {
                if ($data->block == 'N') {
                    $sess_data['user_id'] = $data->user_id;
                    $sess_data['username'] = $username;
                    $sess_data['role'] = $data->role;
                    $this->session->set_userdata($sess_data);
                    if ($data->role == 'superadmin') {
                        redirect(base_url('superadmin'));
                    } else if ($data->role == 'admin') {
                        redirect(base_url('admin'));
                    } else if ($data->role == 'manager') {
                        redirect(base_url('manager'));
                    } else if ($data->role == 'drafter') {
                        redirect(base_url('drafter'));
                    } else if ($data->role == 'tailor') {
                        redirect(base_url('tailor'));
                    } else if ($data->role == 'packing') {
                        redirect(base_url('packing'));
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun anda belum divalidasi!</div>');
                    redirect(base_url('auth'));
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username atau password salah!</div>');
                redirect(base_url('auth'));
            }
        }
    }

    public function register()
    {
        $this->load->view('auth/register');
    }

    public function register_act()
    {
        // Validasi form input
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|trim',
            array('required' => 'Username harus diisi')
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim|min_length[6]',
            array('required' => 'Password harus diisi', 'min_length' => 'Password harus minimal 6 karakter')
        );

        // Ambil data dari form input
        $data = array(
            'username' => $this->input->post('username', TRUE),
            'password' => md5($this->input->post('password', TRUE)),
            'role' => '',
            'block' => ''
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
            // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data harus diisi lengkap!</div>');
            // redirect(base_url('auth/register'));
        } else {
            // Simpan data ke database
            if ($this->users_m->insert_user($data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Registrasi akun berhasil!</div>');
                redirect(base_url('auth/register'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Registrasi akun gagal!</div>');
                redirect(base_url('auth/register'));
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(array(
            'user_id',
            'username',
            'role'
        ));

        redirect(base_url());
    }
}
