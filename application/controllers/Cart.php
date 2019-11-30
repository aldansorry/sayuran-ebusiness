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
		$data = [
			'cart' => $this->cart->contents(),
			'total' => $this->cart->total(),
		];
		echo json_encode($data);
	}

	public function insert()
	{
		$data = array(
			'id'      => 'sku_123ABC',
			'qty'     => 1,
			'price'   => 39.95,
			'name'    => 'T-Shirt',
			'options' => array('Size' => 'L', 'Color' => 'Red')
		);

		$this->cart->insert($data);
	}

	public function update()
	{
		$data = array(
			'rowid' => '0256a32c98ce49afbe2a4eb8c96c5884',
			'qty'   => 1000
		);

		$this->cart->update($data);
	}

	public function remove()
	{
		$this->cart->remove('0256a32c98ce49afbe2a4eb8c96c5884');
	}

	public function destroy()
	{
		$this->cart->destroy();
	}
}
