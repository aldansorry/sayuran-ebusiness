<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{

    var $cname = "Pengguna";

    public function __construct()
    {
        parent::__construct();
        
        if(!$this->session->userdata('login_status')){
            redirect("Login");
        }

        if($this->session->userdata('login_role') != 1){
            redirect("Dashboard");
        }
    }

    public function index()
    {
        #
        $data_pengguna = $this->db
            ->get('pengguna')
            ->result();
        #

        $data = [
            'cname' => $this->cname,
            'data_pengguna' => $data_pengguna,
        ];
        $this->load->view('admin/pengguna/index', $data);
    }

    public function insert()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() == false) {
            $data = [
                'cname' => $this->cname,
            ];
            $this->load->view('admin/pengguna/insert', $data);
        } else {
            $set = $this->input->post();
            $config['upload_path']          = './storage/pengguna/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $config['encrypt_name']         = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $data['gambar_error'] = $this->upload->display_errors();
                $this->load->view('admin/pengguna/insert', $data);
            } else {
                $upload_data = $this->upload->data();
                $set['gambar'] = $upload_data['file_name'];
                $this->db->insert('pengguna', $set);
                redirect($this->cname);
            }
        }
    }

    public function update($id)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() == false) {
            $data = [
                'cname' => $this->cname,
            ];
            $data_pengguna = $this->db->where('id', $id)->get('pengguna')->row(0);
            if ($data_pengguna != null) {
                $_POST['nama'] = $data_pengguna->nama;
                $_POST['alamat'] = $data_pengguna->alamat;
                $_POST['email'] = $data_pengguna->email;
            }
            $this->load->view('admin/pengguna/update', $data);
        } else {
            $data_pengguna = $this->db->where('id', $id)->get('pengguna')->row(0);
            $set = $this->input->post();
            $config['upload_path']          = './storage/pengguna/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $config['file_name']             = $data_pengguna->gambar;
            $config['overwrite']             = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $data['gambar_error'] = $this->upload->display_errors();
                $this->load->view('admin/pengguna/update', $data);
            } else {
                $upload_data = $this->upload->data();
                $set['gambar'] = $upload_data['file_name'];
                $this->db->where('id', $id)->update('pengguna', $set);
                redirect($this->cname);
            }
        }
    }

    public function delete($id)
    {
        $data_pengguna = $this->db->where('id', $id)->get('pengguna')->row(0);
        unlink('storage/pengguna/' . $data_pengguna->gambar);

        $this->db->where('id', $id)->delete('pengguna');
        redirect($this->cname);
    }
}
