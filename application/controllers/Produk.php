<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{

	var $cname = "Produk";

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
		$data_produk = $this->db
			->get('produk')
			->result();
		#

		$data = [
			'cname' => $this->cname,
			'data_produk' => $data_produk,
		];
		$this->load->view('admin/produk/index', $data);
	}

	public function insert()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		$this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data = [
				'cname' => $this->cname,
			];
			$this->load->view('admin/produk/insert', $data);
		} else {
			$set = $this->input->post();
			$config['upload_path']          = './storage/produk/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 2000;
			$config['encrypt_name'] 		= true;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('gambar')) {
				$data['gambar_error'] = $this->upload->display_errors();
				$this->load->view('admin/produk/insert', $data);
			} else {
				$upload_data = $this->upload->data();
				$set['gambar'] = $upload_data['file_name'];
				$this->db->insert('produk', $set);
				redirect($this->cname);
			}
		}
	}

	public function update($id)
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		$this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data = [
				'cname' => $this->cname,
			];
			$data_produk = $this->db->where('id',$id)->get('produk')->row(0);
			if($data_produk != null){
				$_POST['nama'] = $data_produk->nama;
				$_POST['kategori'] = $data_produk->kategori;
				$_POST['keterangan'] = $data_produk->keterangan;
			}
			$this->load->view('admin/produk/update', $data);
		} else {
			$data_produk = $this->db->where('id', $id)->get('produk')->row(0);
			$set = $this->input->post();
			$config['upload_path']          = './storage/produk/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 2000;
			$config['file_name'] 			= $data_produk->gambar;
			$config['overwrite'] 			= true;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('gambar')) {
				$data['gambar_error'] = $this->upload->display_errors();
				$this->load->view('admin/produk/update', $data);
			} else {
				$upload_data = $this->upload->data();
				$set['gambar'] = $upload_data['file_name'];
				$this->db->where('id',$id)->update('produk', $set);
				redirect($this->cname);
			}
		}
	}

	public function delete($id)
	{
		$data_produk = $this->db->where('id', $id)->get('produk')->row(0);
		unlink('storage/produk/'.$data_produk->gambar);
		
		$this->db->where('id',$id)->delete('produk');
		redirect($this->cname);
	}
}
