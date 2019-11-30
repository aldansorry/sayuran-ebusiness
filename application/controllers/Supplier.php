<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{

    var $cname = "Supplier";

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
        $data_supplier = $this->db
            ->get('supplier')
            ->result();
        #

        $data = [
            'cname' => $this->cname,
            'data_supplier' => $data_supplier,
        ];
        $this->load->view('admin/supplier/index', $data);
    }

    public function insert()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required');

        if ($this->form_validation->run() == false) {
            $data = [
                'cname' => $this->cname,
            ];
            $this->load->view('admin/supplier/insert', $data);
        } else {
            $set = $this->input->post();
            $config['upload_path']          = './storage/supplier/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $config['encrypt_name']         = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $data['gambar_error'] = $this->upload->display_errors();
                $this->load->view('admin/supplier/insert', $data);
            } else {
                $upload_data = $this->upload->data();
                $set['gambar'] = $upload_data['file_name'];
                $this->db->insert('supplier', $set);
                redirect($this->cname);
            }
        }
    }

    public function update($id)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required');

        if ($this->form_validation->run() == false) {
            $data = [
                'cname' => $this->cname,
            ];
            $data_supplier = $this->db->where('id', $id)->get('supplier')->row(0);
            if ($data_supplier != null) {
                $_POST['nama'] = $data_supplier->nama;
                $_POST['alamat'] = $data_supplier->alamat;
                $_POST['keterangan'] = $data_supplier->keterangan;
            }
            $this->load->view('admin/supplier/update', $data);
        } else {
            $data_supplier = $this->db->where('id', $id)->get('supplier')->row(0);
            $set = $this->input->post();
            $config['upload_path']          = './storage/supplier/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $config['file_name']             = $data_supplier->gambar;
            $config['overwrite']             = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $data['gambar_error'] = $this->upload->display_errors();
                $this->load->view('admin/supplier/update', $data);
            } else {
                $upload_data = $this->upload->data();
                $set['gambar'] = $upload_data['file_name'];
                $this->db->where('id', $id)->update('supplier', $set);
                redirect($this->cname);
            }
        }
    }

    public function delete($id)
    {
        $data_supplier = $this->db->where('id', $id)->get('supplier')->row(0);
        unlink('storage/supplier/' . $data_supplier->gambar);

        $this->db->where('id', $id)->delete('supplier');
        redirect($this->cname);
    }
}
