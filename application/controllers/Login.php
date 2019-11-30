<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_authUsername');
        $this->form_validation->set_rules('password', 'Password', 'callback_authPassword');

        if ($this->form_validation->run() == false) {
            $this->load->view('login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $data_user = $this->db->where('username',$username)->where('password',$password)->get('user')->row(0);
            $this->session->set_userdata('login_status', true);
            $this->session->set_userdata('login_nama', $data_user->nama);
            $this->session->set_userdata('login_username', $data_user->username);
            $this->session->set_userdata('login_role', $data_user->role);
            $this->session->set_userdata('login_gambar', $data_user->gambar);

            $this->db->where('id',$data_user->id)->update('user',array('last_online' => date('Y-m-d H:i:s')));
            redirect('Dashboard');
        }
    }

    public function authUsername($username)
    {
        $data_user = $this->db->where('username', $username)->get('user')->row(0);
        if ($data_user == null) {
            $this->form_validation->set_message('authUsername', "{field} belum terdaftar");
            return false;
        }
        return true;
    }

    public function authPassword($password)
    {
        $username = $this->input->post('username');
        $data_user = $this->db->where('username', $username)->get('user')->row(0);
        if ($data_user != null) {
            $data_user = $this->db->where('username',$username)->where('password',$password)->get('user')->row(0);
            if ($data_user == null) {
                $this->form_validation->set_message('authPassword', "{field} salah");
                return false;
            }
            return true;
        }
        return true;
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect("Login");
    }
}
