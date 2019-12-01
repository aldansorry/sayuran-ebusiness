<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['produk'] = $this->db->select('produk.*,min(produk_detail.harga) as harga')->join('produk_detail', 'produk.id=produk_detail.fk_produk')->get('produk')->result();
		$this->load->view('home/home', $data);
	}

	public function shop()
	{
		$data['produk'] = $this->db->select('produk.*,min(produk_detail.harga) as harga')->join('produk_detail', 'produk.id=produk_detail.fk_produk')->get('produk')->result();
		$this->load->view('home/shop', $data);
	}

	public function produk($id)
	{
		$data['produk'] = $this->db->select('produk.*,min(produk_detail.harga) as minharga,max(produk_detail.harga) as maxharga')->join('produk_detail', 'produk.id=produk_detail.fk_produk')->where('produk.id', $id)->get('produk')->row(0);
		$this->load->view('home/produk', $data);
	}

	public function cart()
	{
		$this->load->view('home/cart');
	}

	public function checkout()
	{
		$this->load->library('cart');

		$subtotal = $this->cart->total();
		$delivery = 0;
		$coupon = 0;
		$total = $subtotal + $delivery - $coupon;

		if ($subtotal == 0) {
			redirect('Home/cart');
		}
		$data['subtotal'] = $subtotal;
		$data['delivery'] = $delivery;
		$data['coupon'] = $coupon;
		$data['total'] = $total;

		$data['pengguna'] = null;
		if ($this->session->userdata('lg_status')) {
			$data['pengguna'] = $this->db->where('id', $this->session->userdata('lg_id'))->get('pengguna')->row(0);
		}

		$this->load->library('form_validation');

		if (!$this->session->userdata('lg_status')) {
			if ($this->input->post('login')['email'] != '') {
				#login
				$this->form_validation->set_rules('login[email]', 'email', 'trim|required|callback_authEmail');
				$this->form_validation->set_rules('login[password]', 'Password', 'callback_authPasswordCheckout');
			} else {
				#register
				$this->form_validation->set_rules('register[nama]', 'Nama', "trim|required");
			}
		}

		$this->form_validation->set_rules('tanggal_kirim', 'tanggal_kirim', "trim|required");
		$this->form_validation->set_rules('waktu_kirim', 'waktu_kirim', "trim|required");

		if ($this->form_validation->run() == false) {
			$this->load->view('home/checkout', $data);
		} else {
			$payment_method = $this->input->post('payment_method');
			$id_pengguna = 0;
			if (!$this->session->userdata('lg_status')) {
				if ($this->input->post('login')['email'] != '') {
					#login
					$email = $this->input->post('login[email]');
					$password = $this->input->post('login[password]');
					$data_pengguna = $this->db->where('email', $email)->where('password', $password)->get('pengguna')->row(0);
					$this->session->set_userdata('lg_status', true);
					$this->session->set_userdata('lg_nama', $data_pengguna->nama);
					$this->session->set_userdata('lg_email', $data_pengguna->email);
					$this->session->set_userdata('lg_id', $data_pengguna->id);
					$this->session->set_userdata('lg_gambar', $data_pengguna->gambar);

					$this->db->where('id', $data_pengguna->id)->update('pengguna', array('last_online' => date('Y-m-d H:i:s')));

					$id_pengguna = $data_pengguna->id;
				} else {
					#register
					$register = $this->input->post('register');
					$set = [
						'nama' => $register['nama'],
						'alamat' => $register['alamat'],
						'alamatNote' => $register['alamatNote'],
						'kecamatan' => $register['kecamatan'],
						'kodepos' => $register['kodepos'],
						'telepon' => $register['telepon'],
						'email' => $register['email'],
						'password' => $register['password'],
					];
					$this->db->insert('pengguna', $set);

					$id_pengguna = $this->db->insert_id();
				}
			} else {
				$id_pengguna = $this->session->userdata('lg_id');
			}

			$data_pengguna = $this->db->where('id', $id_pengguna)->get('pengguna')->row(0);

			$this->session->set_userdata('lg_status', true);
			$this->session->set_userdata('lg_id', $data_pengguna->id);
			$this->session->set_userdata('lg_nama', $data_pengguna->nama);
			$this->session->set_userdata('lg_email', $data_pengguna->email);
			$this->session->set_userdata('lg_gambar', $data_pengguna->gambar);

			$kode = "";
			do {
				$str_result = '0000111122223333444455556666777788889999AAAABBBBCCCCDDDD';

				$kode = substr(str_shuffle($str_result), 0, 16);

				$exist = $this->db->where('kode', $kode)->get('penjualan')->row(0);
			} while ($exist != null);

			$set_penjualan = [
				'kode' => $kode,
				'tanggal_kirim' => $this->input->post('tanggal_kirim')." ".$this->input->post('waktu_kirim'),
				'status' => '1',
				'fk_pengguna' => $id_pengguna
			];
			$insert_penjualan = $this->db->insert('penjualan', $set_penjualan);
			$id_penjualan = $this->db->insert_id();

			$cart_content = $this->cart->contents();

			foreach ($cart_content as $key => $value) {
				$data_produk = $this->db->where('id', $value['id'])->get('produk_detail')->row(0);
				$set_penjualan_detail = [
					'fk_penjualan' => $id_penjualan,
					'fk_produk_detail' => $data_produk->id,
					'jumlah' => $value['qty'],
					'harga_sekarang' => $data_produk->harga
				];
				$this->db->insert('penjualan_detail', $set_penjualan_detail);
			}
			$this->cart->destroy();
		}
	}

	public function get_produk()
	{
		$kategori = $this->input->post('kategori');
		if ($kategori != '') {
			$this->db->where('produk.kategori', $kategori);
		}

		$search_key = $this->input->post('search_key');
		if ($search_key != '') {
			$this->db->like('produk.nama', $search_key);
		}


		$data['produk'] = $this->db
			->select('produk.*,min(produk_detail.harga) as harga')
			->group_by('produk.id')
			->join('produk_detail', 'produk.id=produk_detail.fk_produk')
			->get('produk')
			->result();
		echo json_encode($data);
	}




	#login
	public function login()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'email', 'trim|required|callback_authEmail');
		$this->form_validation->set_rules('password', 'Password', 'callback_authPassword');

		if ($this->form_validation->run() == false) {
			$this->load->view('home/login');
		} else {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$data_pengguna = $this->db->where('email', $email)->where('password', $password)->get('pengguna')->row(0);
			$this->session->set_userdata('lg_status', true);
			$this->session->set_userdata('lg_nama', $data_pengguna->nama);
			$this->session->set_userdata('lg_email', $data_pengguna->email);
			$this->session->set_userdata('lg_id', $data_pengguna->id);
			$this->session->set_userdata('lg_gambar', $data_pengguna->gambar);

			$this->db->where('id', $data_pengguna->id)->update('pengguna', array('last_online' => date('Y-m-d H:i:s')));
			redirect('Home');
		}
	}

	public function authEmail($email)
	{
		$data_pengguna = $this->db->where('email', $email)->get('pengguna')->row(0);
		if ($data_pengguna == null) {
			$this->form_validation->set_message('authEmail', "{field} belum terdaftar");
			return false;
		}
		return true;
	}

	public function authPasswordCheckout($password)
	{
		$email = $this->input->post('login[email]');
		$data_pengguna = $this->db->where('email', $email)->get('pengguna')->row(0);
		if ($data_pengguna != null) {
			$data_pengguna = $this->db->where('email', $email)->where('password', $password)->get('pengguna')->row(0);
			if ($data_pengguna == null) {
				$this->form_validation->set_message('authPasswordCheckout', "{field} salah");
				return false;
			}
			return true;
		}

		$this->form_validation->set_message('authPasswordCheckout', "");
		return false;
	}

	public function authPassword($password)
	{
		$email = $this->input->post('email');
		$data_pengguna = $this->db->where('email', $email)->get('pengguna')->row(0);
		if ($data_pengguna != null) {
			$data_pengguna = $this->db->where('email', $email)->where('password', $password)->get('pengguna')->row(0);
			if ($data_pengguna == null) {
				$this->form_validation->set_message('authPassword', "{field} salah");
				return false;
			}
			return true;
		}

		$this->form_validation->set_message('authPassword', "");
		return false;
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect("Home");
	}

	public function register()
	{
		$this->load->view('home/register');
	}

	public function pembelian()
	{
		$this->load->view('home/pembelian');
	}

	public function buktipembayaran($kode)
	{
		if (!isset($_FILES['gambar'])) {
			$data['kode'] = $kode;
			$this->load->view('home/buktipembayaran', $data);
		} else {
			$config['upload_path']          = './storage/buktipembayaran/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 2000;
			$config['file_name'] 		= $kode.".jpg";

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('gambar')) {
				$data['gambar_error'] = $this->upload->display_errors();
				$data['kode'] = $kode;
				$this->load->view('home/buktipembayaran', $data);
			} else {
				$upload_data = $this->upload->data();
				$set['status'] = 2;
				$set['bukti_pembayaran'] = $upload_data['file_name'];
				$this->db->where('kode',$kode)->update('penjualan', $set);
				redirect('Home/pembelian');
			}
		}
	}
}
