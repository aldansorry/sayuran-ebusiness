<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    var $cname = "User";

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
        $data_user = $this->db
            ->select('user.*,supplier.nama as supplier_nama')
            ->join('supplier','user.fk_supplier=supplier.id','left')
            ->get('user')
            ->result();
        #

        $data = [
            'cname' => $this->cname,
            'data_user' => $data_user,
        ];
        $this->load->view('admin/user/index', $data);
    }

    public function insert()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('role', 'role', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data = [
                'cname' => $this->cname,
            ];
            $this->load->view('admin/user/insert', $data);
        } else {
            $set = $this->input->post();
            $config['upload_path']          = './storage/user/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $config['encrypt_name']         = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $data['gambar_error'] = $this->upload->display_errors();
                $this->load->view('admin/user/insert', $data);
            } else {
                $upload_data = $this->upload->data();
                $set['gambar'] = $upload_data['file_name'];
                $this->db->insert('user', $set);
                redirect($this->cname);
            }
        }
    }

    public function update($id)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('role', 'role', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data = [
                'cname' => $this->cname,
            ];
            $data_user = $this->db->where('id', $id)->get('user')->row(0);
            if ($data_user != null) {
                $_POST['nama'] = $data_user->nama;
                $_POST['username'] = $data_user->username;
                $_POST['role'] = $data_user->role;
            }
            $this->load->view('admin/user/update', $data);
        } else {
            $data_user = $this->db->where('id', $id)->get('user')->row(0);
            $set = $this->input->post();
            $config['upload_path']          = './storage/user/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $config['file_name']             = $data_user->gambar;
            $config['overwrite']             = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $data['gambar_error'] = $this->upload->display_errors();
                $this->load->view('admin/user/update', $data);
            } else {
                $upload_data = $this->upload->data();
                $set['gambar'] = $upload_data['file_name'];
                $this->db->where('id', $id)->update('user', $set);
                redirect($this->cname);
            }
        }
    }

    public function delete($id)
    {
        $data_user = $this->db->where('id', $id)->get('user')->row(0);
        unlink('storage/user/' . $data_user->gambar);

        $this->db->where('id', $id)->delete('user');
        redirect($this->cname);
    }
}
