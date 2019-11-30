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

	public function produk($id)
	{
		$data['produk'] = $this->db->select('produk.*,min(produk_detail.harga) as minharga,max(produk_detail.harga) as maxharga')->join('produk_detail','produk.id=produk_detail.fk_produk')->where('produk.id',$id)->get('produk')->row(0);
		$this->load->view('home/produk',$data);
	}
}
