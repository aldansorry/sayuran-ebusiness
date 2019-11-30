<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProdukDetail extends CI_Controller
{

	var $cname = "ProdukDetail";

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

	public function set_produk($id = null)
	{
		if ($id == null) {
			$this->session->unset_userdata('produkdetail_id');
		} else {
			$this->session->set_userdata('produkdetail_id', $id);
		}
		redirect($this->cname);
	}

	public function index()
	{
		$data_produk = null;
		#
		if ($produk_id = $this->session->userdata('produkdetail_id') != null) {
			$produk_id = $this->session->userdata('produkdetail_id');
			$data_produk = $this->db->where('id', $produk_id)->get('produk')->row(0);
			$this->db->where('produk_detail.fk_produk', $produk_id);
		}
		$data_produk_detail = $this->db
			->select('produk_detail.*,produk.nama as produk_nama')
			->join('produk', 'produk_detail.fk_produk=produk.id')
			->get('produk_detail')
			->result();
		#

		$data = [
			'cname' => $this->cname,
			'data_produk' => $data_produk,
			'data_produk_detail' => $data_produk_detail,
		];
		$this->load->view('admin/produkdetail/index', $data);
	}

	public function insert()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
		$this->form_validation->set_rules('satuan', 'satuan', 'trim|required');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data = [
				'cname' => $this->cname,
			];
			$this->load->view('admin/produkdetail/insert', $data);
		} else {
			$set = $this->input->post();
			$config['upload_path']          = './storage/produk/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 2000;
			$config['encrypt_name'] 		= true;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('gambar')) {
				$data['gambar_error'] = $this->upload->display_errors();
				$this->load->view('admin/produkdetail/insert', $data);
			} else {
				$upload_data = $this->upload->data();
				$set['gambar'] = $upload_data['file_name'];
				$this->db->insert('produk_detail', $set);
				redirect($this->cname);
			}
		}
	}

	public function update($id)
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
		$this->form_validation->set_rules('satuan', 'satuan', 'trim|required');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data = [
				'cname' => $this->cname,
			];
			$data_produk_detail = $this->db->where('id', $id)->get('produk_detail')->row(0);
			if ($data_produk_detail != null) {
				$_POST['fk_produk'] = $data_produk_detail->fk_produk;
				$_POST['jenis'] = $data_produk_detail->jenis;
				$_POST['satuan'] = $data_produk_detail->satuan;
				$_POST['harga'] = $data_produk_detail->harga;
			}
			$this->load->view('admin/produkdetail/update', $data);
		} else {
			$data_produk_detail = $this->db->where('id', $id)->get('produk_detail')->row(0);
			$set = $this->input->post();
			$config['upload_path']          = './storage/produk/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 2000;
			$config['file_name'] 			= $data_produk_detail->gambar;
			$config['overwrite'] 			= true;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('gambar')) {
				$data['gambar_error'] = $this->upload->display_errors();
				$this->load->view('admin/produkdetail/update', $data);
			} else {
				$upload_data = $this->upload->data();
				$set['gambar'] = $upload_data['file_name'];
				$this->db->where('id', $id)->update('produk_detail', $set);
				redirect($this->cname);
			}
		}
	}

	public function delete($id)
	{

		$data_produk_detail = $this->db->where('id', $id)->get('produk_detail')->row(0);
		unlink('storage/produk/' . $data_produk_detail->gambar);
		$this->db->where('id', $id)->delete('produk_detail');

		redirect($this->cname);
	}
}
