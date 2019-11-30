<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{

	var $cname = "Produk";

	public function __construct()
	{
		parent::__construct();
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
		$this->form_validation->set_rules('sayur', 'sayur', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data = [
				'cname' => $this->cname,
			];
			$this->load->view('admin/produk/insert', $data);
		} else {
			$set = $this->input->post();
			$this->db->insert('produk', $set);
			redirect($this->cname);
		}
	}

	public function update($id)
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		$this->form_validation->set_rules('sayur', 'sayur', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data = [
				'cname' => $this->cname,
			];
			$data_produk = $this->db->where('id',$id)->get('produk')->row(0);
			if($data_produk != null){
				$_POST['nama'] = $data_produk->nama;
				$_POST['sayur'] = $data_produk->sayur;
				$_POST['keterangan'] = $data_produk->keterangan;
			}
			$this->load->view('admin/produk/update', $data);
		} else {
			$set = $this->input->post();
			$this->db->where('id',$id)->update('produk', $set);
			redirect($this->cname);
		}
	}

	public function delete($id)
	{
		$this->db->where('id',$id)->delete('produk');
		redirect($this->cname);
	}
}
