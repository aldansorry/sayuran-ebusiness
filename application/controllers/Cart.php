<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
	}

	public function get_content()
	{
		$cart = [];
		foreach($this->cart->contents() as $key => $value){
			array_push($cart,[
				'cartId' => $key,
				'id' => $value['id'],
				'quantity' => $value['qty'],
				'harga' => $value['price'],
				'subtotal' => $value['subtotal'],
				'name' => $value['name'],
				'jenis' => $value['options']['jenis'],
				'satuan' => $value['options']['satuan'],
				'gambar' => $value['options']['gambar']
			]);
		}

		$data = [
			'cart' => $cart,
			'total' => $this->cart->total(),
		];
		echo json_encode($data);
	}

	public function get_sum()
	{
		echo count($this->cart->contents());
	}

	public function insert()
	{
		$id_produk = $this->input->post('id_produk');
		$quantity = $this->input->post('quantity');
		$data_produk = $this->db
		->select('produk_detail.*,produk.nama as produk_nama')
		->join('produk','produk_detail.fk_produk=produk.id')
		->where('produk_detail.id',$id_produk)
		->get('produk_detail')
		->row(0);

		echo json_encode($data_produk);

		$data = array(
			'id'      => $id_produk,
			'qty'     => $quantity,
			'price'   => $data_produk->harga,
			'name'    => $data_produk->produk_nama,
			'options' => array('jenis' => $data_produk->jenis, 'satuan' => $data_produk->satuan,'gambar' => $data_produk->gambar)
		);

		$this->cart->insert($data);
	}

	public function update()
	{
		$data = array(
			'rowid' => $this->input->post('cartid'),
			'qty'   => $this->input->post('quantity')
		);

		$this->cart->update($data);
	}

	public function remove()
	{
		$this->cart->remove($this->input->post('cartid'));
	}

	public function destroy()
	{
		$this->cart->destroy();
	}
}
