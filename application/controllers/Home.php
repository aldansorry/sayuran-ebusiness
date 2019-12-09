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
		$data['produk'] = $this->db
			->select('produk.*,min(produk_detail.harga) as harga')
			->group_by('produk.id')
			->join('produk_detail', 'produk.id=produk_detail.fk_produk')
			->get('produk')
			->result();
		$this->load->view('home/home', $data);
	}

	public function shop()
	{
		$this->load->view('home/shop');
	}

	public function produk($id)
	{
		$data['related_produk'] = $this->db
			->select('produk.*,min(produk_detail.harga) as harga')
			->group_by('produk.id')
			->join('produk_detail', 'produk.id=produk_detail.fk_produk')
			->where('produk.id !=', $id)
			->get('produk')
			->result();
		$data['produk'] = $this->db->select('produk.*,min(produk_detail.harga) as minharga,max(produk_detail.harga) as maxharga')->join('produk_detail', 'produk.id=produk_detail.fk_produk')->where('produk.id', $id)->get('produk')->row(0);
		$this->load->view('home/produk', $data);
	}

	public function cart()
	{
		$this->load->view('home/cart');
	}

	public function checkout()
	{
		if (!$this->session->userdata('lg_status')) {
			redirect('Home/login');
		}
		$this->load->library('cart');

		$subtotal = $this->cart->total();
		$delivery = 0;
		if ($subtotal < 100000) {
			$delivery = 10000;
		}
		$total = $subtotal + $delivery;

		if ($subtotal == 0) {
			redirect('Home/cart');
		}
		$data['subtotal'] = $subtotal;
		$data['delivery'] = $delivery;
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
				$this->form_validation->set_rules('register[nama]', 'nama', "trim|required");
				$this->form_validation->set_rules('register[alamat]', 'alamat', "trim|required");
				$this->form_validation->set_rules('register[alamatNote]', 'alamatNote', "trim");
				$this->form_validation->set_rules('register[kecamatan]', 'kecamatan', "trim|required");
				$this->form_validation->set_rules('register[kodepos]', 'kodepos', "trim|required");
				$this->form_validation->set_rules('register[telepon]', 'telepon', "trim|required");
				$this->form_validation->set_rules('register[email]', 'email', "trim|required|is_unique[pengguna.email]");
				$this->form_validation->set_rules('register[password]', 'Password', "required|matches[register[repassword]]");
				$this->form_validation->set_rules('register[repassword]', 'repassword', "required");
			}
		}

		$this->form_validation->set_rules('tanggal_kirim', 'tanggal_kirim', "trim|required");
		$this->form_validation->set_rules('waktu_kirim', 'waktu_kirim', "trim|required");
		$this->form_validation->set_rules('term', 'Term And Condition', "callback_accept_terms");
		$this->form_validation->set_rules('payment_method', 'Payment', "callback_checkbalance");

		if ($this->form_validation->run() == false) {
			$this->load->view('home/checkout', $data);
		} else {
			$payment_method = $this->input->post('payment_method');

			$id_pengguna = $this->session->userdata('lg_id');

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
				'tanggal_kirim' => $this->input->post('tanggal_kirim') . " " . $this->input->post('waktu_kirim'),
				'status' => ($payment_method == 1 ? '1' : '2'),
				'payment_method' => $payment_method,
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


			##menggurangi point
			if ($payment_method == '2') {

				$data_pengguna = $this->db->where('id', $id_pengguna)->get('pengguna')->row(0);
				$set_point['point'] = $data_pengguna->point - $total;

				$this->db->where('id', $data_pengguna->id)->update('pengguna', $set_point);
			}
			redirect('Home/pembelian');
		}
	}

	public function accept_terms()
	{
		if (isset($_POST['term'])) return true;
		$this->form_validation->set_message('accept_terms', 'Please read and accept our terms and conditions.');
		return false;
	}

	public function checkbalance()
	{
		if ($_POST['payment_method'] == 2) {
			$point = $this->db->select('point')->where('id', $this->session->userdata('lg_id'))->get('pengguna')->row(0)->point;

			$this->load->library('cart');

			$subtotal = $this->cart->total();
			$delivery = 0;
			if ($subtotal < 100000) {
				$delivery = 10000;
			}
			$total = $subtotal + $delivery;
			if ($total > $point) {

				$this->form_validation->set_message('checkbalance', 'Point tidak cukup untuk melakukan pembelian');
				return false;
			} else {
				return true;
			}
		} else {
			return true;
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
		$this->load->library('form_validation');

		$this->form_validation->set_rules('register[nama]', 'nama', "trim|required");
		$this->form_validation->set_rules('register[alamat]', 'alamat', "trim|required");
		$this->form_validation->set_rules('register[alamatNote]', 'alamatNote', "trim");
		$this->form_validation->set_rules('register[kecamatan]', 'kecamatan', "trim|required");
		$this->form_validation->set_rules('register[kodepos]', 'kodepos', "trim|required");
		$this->form_validation->set_rules('register[telepon]', 'telepon', "trim|required");
		$this->form_validation->set_rules('register[email]', 'email', "trim|required|is_unique[pengguna.email]");
		$this->form_validation->set_rules('register[password]', 'Password', "required|matches[register[repassword]]");
		$this->form_validation->set_rules('register[repassword]', 'repassword', "required");

		if ($this->form_validation->run() == false) {
			$this->load->view('home/register');
		} else {
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

			$data_pengguna = $this->db->where('id', $id_pengguna)->get('pengguna')->row(0);
			$this->session->set_userdata('lg_status', true);
			$this->session->set_userdata('lg_nama', $data_pengguna->nama);
			$this->session->set_userdata('lg_email', $data_pengguna->email);
			$this->session->set_userdata('lg_id', $data_pengguna->id);
			$this->session->set_userdata('lg_gambar', $data_pengguna->gambar);

			$this->db->where('id', $data_pengguna->id)->update('pengguna', array('last_online' => date('Y-m-d H:i:s')));
			redirect('Home');
		}
	}

	public function profile()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('register[nama]', 'nama', "trim|required");
		$this->form_validation->set_rules('register[alamat]', 'alamat', "trim|required");
		$this->form_validation->set_rules('register[alamatNote]', 'alamatNote', "trim");
		$this->form_validation->set_rules('register[kecamatan]', 'kecamatan', "trim|required");
		$this->form_validation->set_rules('register[kodepos]', 'kodepos', "trim|required");
		$this->form_validation->set_rules('register[telepon]', 'telepon', "trim|required");
		if ($this->input->post('register[password]') != "") {

			$this->form_validation->set_rules('register[password]', 'Password', "required|matches[register[repassword]]");
			$this->form_validation->set_rules('register[repassword]', 'repassword', "required");
		}

		if ($this->form_validation->run() == false) {
			$data['point'] = $this->db->select('point')->where('id', $this->session->userdata('lg_id'))->get('pengguna')->row(0)->point;
			$data['pengguna'] = $this->db->where('id', $this->session->userdata('lg_id'))->get('pengguna')->row(0);
			$this->load->view('home/profile', $data);
		} else {
			$register = $this->input->post('register');
			$set = [
				'nama' => $register['nama'],
				'alamat' => $register['alamat'],
				'alamatNote' => $register['alamatNote'],
				'kecamatan' => $register['kecamatan'],
				'kodepos' => $register['kodepos'],
				'telepon' => $register['telepon'],
			];
			if ($this->input->post('register[password]') != "") {
				$set['password'] = $register['password'];
			}
			$this->db->where('id', $this->session->userdata('lg_id'))->update('pengguna', $set);

			redirect('Home/profile');
		}
	}

	public function about()
	{
		$this->load->view('home/about');
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
			$config['file_name'] 		= $kode . ".jpg";

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('gambar')) {
				$data['gambar_error'] = $this->upload->display_errors();
				$data['kode'] = $kode;
				$this->load->view('home/buktipembayaran', $data);
			} else {
				$upload_data = $this->upload->data();
				$set['status'] = 2;
				$set['bukti_pembayaran'] = $upload_data['file_name'];
				$this->db->where('kode', $kode)->update('penjualan', $set);
				redirect('Home/pembelian');
			}
		}
	}
}
