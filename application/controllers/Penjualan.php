<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		if(!$this->session->userdata('login_status')){
            redirect("Login");
        }
		
	}
	
	public function index()
	{
		$data['data_penjualan'] = $this->db
		->get('penjualan')
		->result();
		$this->load->view('admin/penjualan/index',$data);
	}

	public function konfirmasipembeyaran()
	{
		$data['data_penjualan'] = $this->db
		->select('penjualan.*,(select sum(jumlah*harga_sekarang) from penjualan_detail where fk_penjualan=penjualan.id) total')
		->where('status',2)
		->get('penjualan')
		->result();
		$this->load->view('admin/penjualan/konfirmasipembeyaran',$data);
	}

	public function set_konfirmasi($id)
	{
		$set['status'] = 3;
		$this->db->where('id',$id)->update('penjualan',$set);
		redirect('Penjualan/konfirmasipembeyaran');
	}

	public function pengiriman()
	{
		$this->load->view('admin/penjualan/pengiriman');
	}

	public function set_pengiriman($id)
	{
		$set['status'] = 4;
		$this->db->where('id',$id)->update('penjualan',$set);
		redirect('Penjualan/pengiriman');
	}

	public function selesai()
	{
		$this->load->view('admin/penjualan/selesai');
	}

	public function set_selesai($id)
	{
		$set['status'] = 5;
		$this->db->where('id',$id)->update('penjualan',$set);
		redirect('Penjualan/selesai');
	}
}
