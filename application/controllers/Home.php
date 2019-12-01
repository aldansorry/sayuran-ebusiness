<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		
	}
	
	public function index()
	{
		$data['produk'] = $this->db->select('produk.*,min(produk_detail.harga) as harga')->join('produk_detail','produk.id=produk_detail.fk_produk')->get('produk')->result();
		$this->load->view('home/home',$data);
	}

	public function shop()
	{
		$data['produk'] = $this->db->select('produk.*,min(produk_detail.harga) as harga')->join('produk_detail','produk.id=produk_detail.fk_produk')->get('produk')->result();
		$this->load->view('home/shop',$data);
	}

	public function produk($id)
	{
		$data['produk'] = $this->db->select('produk.*,min(produk_detail.harga) as minharga,max(produk_detail.harga) as maxharga')->join('produk_detail','produk.id=produk_detail.fk_produk')->where('produk.id',$id)->get('produk')->row(0);
		$this->load->view('home/produk',$data);
	}

	public function cart()
	{
		$this->load->view('home/cart');
	}

	public function get_produk()
	{
		$kategori = $this->input->post('kategori');
		if($kategori != ''){
			$this->db->where('produk.kategori',$kategori);
		}

		$search_key = $this->input->post('search_key');
		if($search_key != ''){
			$this->db->like('produk.nama',$search_key);
		}


		$data['produk'] = $this->db
		->select('produk.*,min(produk_detail.harga) as harga')
		->group_by('produk.id')
		->join('produk_detail','produk.id=produk_detail.fk_produk')
		->get('produk')
		->result();
		echo json_encode($data);
	}
}
