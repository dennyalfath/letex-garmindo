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
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        // Jika validasi input username dan password bernilai false maka user/admin diminta melakukan input ulang
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth');
            // Menampilkan halaman utama login
        } else {
            // Input username dan password dengan fungsi POST 
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));

            $cek = $this->users_m->get_by_login_data($username, $password);
            if ($cek->num_rows() > 0) {
                foreach ($cek->result() as $qad) {
                    if ($qad->block == 'N') {
                        $sess_data['user_id'] = $qad->user_id;
                        $sess_data['username'] = $username;
                        $this->session->set_userdata($sess_data);
                        redirect(base_url('company'));
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun anda belum divalidasi!</div>');
                        redirect(base_url('auth'));
                    }
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
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');

        // Ambil data dari form input
        $data = array(
            'username' => $this->input->post('username', TRUE),
            'password' => md5($this->input->post('password', TRUE))
        );

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data harus diisi lengkap!</div>');
            redirect(base_url('auth/register'));
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
        ));

        redirect(base_url());
    }
}
