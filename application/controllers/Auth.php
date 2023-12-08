<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('pengaturan_model');
		$this->load->model('user_model');
		$this->load->model('meta_model');
	}

	public function index()
	{
		if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2  || $this->session->userdata('role_id') == 3) {
			redirect('admin/dashboard');
		} elseif ($this->session->userdata('role_id') == 5) {
			redirect('driver/dashboard');
		} elseif ($this->session->userdata('role_id') == 4) {
			redirect('counter/dashboard');
		} elseif ($this->session->userdata('role_id') == 6) {
			redirect('myaccount');
		} else {
			$this->form_validation->set_rules(
				'email',
				'Email',
				'required|trim|valid_email',
				[
					'required' 		=> 'Email harus di isi',
					'valid_email' 	=> 'Format email Tidak sesuai'
				]
			);
			$this->form_validation->set_rules(
				'password',
				'Password',
				'required|trim',
				[
					'required' 		=> 'Password harus di isi',
				]
			);
			if ($this->form_validation->run() == false) {
				if (!$this->agent->is_mobile()) {
					// Desktop View
					$data = [
						'title' 		=> 'Login',
						'content'       => 'front/auth/login'
					];
					$this->load->view('front/layout/wrapp', $data, FALSE);
				} else {
					// Mobile View
					$data = [
						'title' 		=> 'Login',
						'content'       => 'mobile/auth/login'
					];
					$this->load->view('mobile/layout/wrapp', $data, FALSE);
				}
			} else {
				//Validasi Berhasil
				$this->_login();
			}
		}
	}
	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if ($user) {
			//User Ada
			//Jika User Aktif
			if ($user['is_active'] == 1) {
				// Cek Locked
				if ($user['is_locked'] == 1) {
					//Cek Password
					if (password_verify($password, $user['password'])) {
						//Password Berhasil
						$data  = [
							'email'		=> $user['email'],
							'role_id'	=> $user['role_id'],
							'id'		=> $user['id'],
						];
						$this->session->set_userdata($data);
						if ($user['role_id'] == 1 || $user['role_id'] == 2 || $user['role_id'] == 3) {
							redirect('admin/dashboard');
						} elseif ($user['role_id'] == 4) {
							redirect('counter/dashboard');
						} elseif ($user['role_id'] == 5) {
							redirect('driver/dashboard');
						} elseif ($user['role_id'] == 6) {
							if (!$this->agent->is_mobile()) {
								// Desktop View
								redirect('myaccount');
							} else {
								// Mobile View
								redirect('myaccount');
							}
						}
					} else {
						//Password Salah
						$this->session->set_flashdata('message', '<div class="alert alert-danger">Password Salah</div> ');
						redirect('auth');
					}
				} else {
					//User Locked
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Akun Anda masih Di Kunci Silahkan Hubungi Admin</div> ');
					redirect('auth');
				}
			} else {
				//User tidak Aktif
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Email Belum di Aktivasi, Silahkan Cek email anda</div> ');
				redirect('auth');
			}
		} else {
			//User tidak ada
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Email Tidak Terdaftar</div> ');
			redirect('auth');
		}
	}

	public function register()
	{
		if ($this->session->userdata('id')) {
			redirect('auth');
		}

		$this->form_validation->set_rules(
			'name',
			'Nama',
			'required|trim',
			['required' => 'nama harus di isi']
		);
		$this->form_validation->set_rules(
			'real_email',
			'Email',
			'required|trim|valid_email|is_unique[user.email]',
			[
				'required' 		=> 'Email Harus diisi',
				'valid_email' 	=> 'Email Harus Valid',
				'is_unique'		=> 'Email Sudah ada, Gunakan Email lain'
			]
		);
		$this->form_validation->set_rules(
			'password1',
			'Password',
			'required|trim|min_length[3]|matches[password2]',
			[
				'matches' 		=> 'Password tidak sama',
				'min_length' 	=> 'Password Min 3 karakter'
			]
		);
		$this->form_validation->set_rules('user_phone', 'Nomor Whatsapp', 'required|trim|min_length[1]');
		$this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			if (!$this->agent->is_mobile()) {
				// Desktop View
				$data = [
					'title'			=> 'Register',
					'content'       => 'front/auth/register'
				];
				$this->load->view('front/layout/wrapp', $data, FALSE);
			} else {
				// Mobile View
				$data = [
					'title'			=> 'Register',
					'content'       => 'mobile/auth/register'
				];
				$this->load->view('mobile/layout/wrapp', $data, FALSE);
			}
		} else {
			$email = $this->input->post('real_email', true);
			$user_phone = $this->input->post('user_phone');
			$phone = str_replace(' ', '', $user_phone);
			$phone = str_replace('-', '', $user_phone);

			// Ubah 0 menjadi 62
			// kadang ada penulisan no hp 0811 239 345
			$phone = str_replace(" ", "", $phone);
			// kadang ada penulisan no hp (0274) 778787
			$phone = str_replace("(", "", $phone);
			// kadang ada penulisan no hp (0274) 778787
			$phone = str_replace(")", "", $phone);
			// kadang ada penulisan no hp 0811.239.345
			$phone = str_replace(".", "", $phone);

			// cek apakah no hp mengandung karakter + dan 0-9
			if (!preg_match('/[^+0-9]/', trim($phone))) {
				// cek apakah no hp karakter 1-3 adalah +62
				if (substr(trim($phone), 0, 3) == '62') {
					$hp = trim($phone);
				}
				// cek apakah no hp karakter 1 adalah 0
				elseif (substr(trim($phone), 0, 1) == '0') {
					$hp = '62' . substr(trim($phone), 1);
				}
			}

			$data = [
				'user_title'	=> $this->input->post('user_title'),
				'name' 			=> htmlspecialchars($this->input->post('name', true)),
				'email' 		=> htmlspecialchars($email),
				'user_image' 	=> 'default.jpg',
				'user_phone'	=> $hp,
				'password'		=> password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id'		=> 6,
				'is_active'		=> 0,
				'is_locked'		=> 1,
				'date_created'	=> date('Y-m-d H:i:s')
			];
			//Token
			$token = openssl_random_pseudo_bytes(16);
			$token = bin2hex($token);

			$user_token = [
				'user_phone'	=> $hp,
				'token'			=> $token,
				'date_created'	=>  date('Y-m-d H:i:s')
			];
			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);
			//Kirim Email
			// $this->_sendEmail($token, 'verify');
			$this->_sendWhatsapp($token, $hp, 'verify');
			$this->_deleteUser($email);

			$this->session->set_flashdata('message', '<div class="alert alert-success">Selamat Anda berhasil mendaftar, silahkan Aktivasi akun</div>');
			redirect('auth');
		}
	}
	public function _sendWhatsapp($token, $hp, $type)
	{
		$meta = $this->meta_model->get_meta();
		$whatsapp_key = $meta->whatsapp_api;

		if ($type == 'verify') {
			$message = "Silahkan Klik Link ini untuk mengaktivasi akun " . base_url() . "auth/verify?user_phone=" . $hp . "&token=" . $token . " ";
		} elseif ($type == 'forgot') {
			$message = 'Silahkan Klik Link ini untuk Mereset Password 
			' . base_url() . 'auth/resetpassword?user_phone=' . $hp . '&token=' . $token . ' ';
		}

		$apikey = $whatsapp_key;
		$tujuan = $hp;
		$pesan = $message;

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.fonnte.com/send',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',

			CURLOPT_POSTFIELDS => array(
				'target' => $tujuan,
				'message' => $pesan,
				'countryCode' => '62', //optional
			),

			CURLOPT_HTTPHEADER => array(
				'Authorization: ' . $apikey //change TOKEN to your actual token
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$response;
	}

	public function verify()
	{
		$user_phone = $this->input->get('user_phone');
		$token = $this->input->get('token');


		$user = $this->db->get_where('user', ['user_phone' => $user_phone])->row_array();
		$user_id = $user['id'];


		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
			if ($user_token) {
				$data = [
					'id'		=> $user_id,
					'is_active' => 1,
				];

				$this->user_model->update($data);
				$this->db->delete('user_token', ['user_phone' => $user_phone]);
				$this->session->set_flashdata('message', '<div class="alert alert-success">Selamat email ' . $user_phone . '  sudah di aktivasi, Silahkan login!</div> ');
				redirect('auth');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Aktivasi akun Gagal, Token salah!</div> ');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Aktivasi akun Gagal, Nomor Handphone tidak terdaftar!</div> ');
			redirect('auth');
		}
	}
	public function forgotPassword()
	{



		$this->form_validation->set_rules(
			'user_phone',
			'Nomor Hp',
			'required',
			[
				'required' 		=> 'Email harus di isi',
			]
		);
		if ($this->form_validation->run() == false) {
			if (!$this->agent->is_mobile()) {

				$data = [
					'title'		=> 'Forgot Password',
					'content'	=> 'front/auth/forgot_password'
				];
				$this->load->view('front/layout/wrapp', $data, FALSE);
			} else {

				$data = [
					'title'		=> 'Forgot Password',
					'content'	=> 'mobile/auth/forgot_password'
				];
				$this->load->view('mobile/layout/wrapp', $data, FALSE);
			}
		} else {



			$user_phone = $this->input->post('user_phone');
			$phone = str_replace(' ', '', $user_phone);
			$phone = str_replace('-', '', $user_phone);
			$phone = str_replace(" ", "", $phone);
			$phone = str_replace("(", "", $phone);
			$phone = str_replace(")", "", $phone);
			$phone = str_replace(".", "", $phone);
			if (!preg_match('/[^+0-9]/', trim($phone))) {

				if (substr(trim($phone), 0, 3) == '62') {
					$hp = trim($phone);
				} elseif (substr(trim($phone), 0, 1) == '0') {
					$hp = '62' . substr(trim($phone), 1);
				}
			}

			$user_phone = $this->db->get_where('user', ['user_phone' => $hp, 'is_active' => 1])->row_array();
			if ($user_phone) {

				$user_id = $user_phone['id'];
				$new_password =  random_string('numeric', 5);

				$data = [
					'id'			=> $user_id,
					'password'		=> password_hash($new_password, PASSWORD_DEFAULT),


				];

				$this->user_model->update($data);
				$this->_sendPassword($user_phone, $new_password);
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Silahkan cek Pesan Whatsapp ke nomor ' . $user_phone['user_phone'] . ' untuk mereset password</div> ');
				redirect('auth');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Nomor Whatsapp Tidak Terdaftar atau belum di aktivasi</div> ');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function _sendPassword($user_phone, $new_password)
	{
		$meta = $this->meta_model->get_meta();
		$whatsapp_key = $meta->whatsapp_api;
		$phone = $user_phone['user_phone'];
		$email = $user_phone['email'];

		$message = "
		Silahkan Gunakan Data Berikut 
		Untuk Login Ke Aplikasi
		----------------------------
		Email    : " . $email . "
		Password : " . $new_password . "
		----------------------------
		Silahkan Login lalu
		ubah kembali password 
		anda.
		
		";

		$apikey = $whatsapp_key;
		$tujuan = $phone;
		$pesan = $message;

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://starsender.online/api/sendText?message=' . rawurlencode($pesan) . '&tujuan=' . rawurlencode($tujuan . '@s.whatsapp.net'),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_HTTPHEADER => array(
				'apikey: ' . $apikey
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$response;
	}

	// public function forgotPassword()
	// {
	// 	$this->form_validation->set_rules(
	// 		'whatsapp',
	// 		'Email',
	// 		'required',
	// 		[
	// 			'required' 		=> 'Email harus di isi',
	// 		]
	// 	);
	// 	if ($this->form_validation->run() == false) {
	// 		if (!$this->agent->is_mobile()) {

	// 			$data = [
	// 				'title'		=> 'Forgot Password',
	// 				'content'	=> 'front/auth/forgot_password'
	// 			];
	// 			$this->load->view('front/layout/wrapp', $data, FALSE);
	// 		} else {

	// 			$data = [
	// 				'title'		=> 'Forgot Password',
	// 				'content'	=> 'mobile/auth/forgot_password'
	// 			];
	// 			$this->load->view('mobile/layout/wrapp', $data, FALSE);
	// 		}
	// 	} else {


	// 		$user_phone = $this->input->post('user_phone');
	// 		$phone = str_replace(' ', '', $user_phone);
	// 		$phone = str_replace('-', '', $user_phone);


	// 		$phone = str_replace(" ", "", $phone);

	// 		$phone = str_replace("(", "", $phone);

	// 		$phone = str_replace(")", "", $phone);

	// 		$phone = str_replace(".", "", $phone);


	// 		if (!preg_match('/[^+0-9]/', trim($phone))) {

	// 			if (substr(trim($phone), 0, 3) == '62') {
	// 				$hp = trim($phone);
	// 			}

	// 			elseif (substr(trim($phone), 0, 1) == '0') {
	// 				$hp = '62' . substr(trim($phone), 1);
	// 			}
	// 		}

	// 		$user = $this->db->get_where('user', ['user_phone' => $hp, 'is_active' => 1])->row_array();
	// 		if ($user) {

	// 			$token = openssl_random_pseudo_bytes(16);
	// 			$token = bin2hex($token);

	// 			$user_token = [
	// 				'user_phone'			=> $hp,
	// 				'token'			=> $token,
	// 				'date_created'	=> time()
	// 			];
	// 			$this->db->insert('user_token', $user_token);
	// 			$this->_sendWhatsapp($token, $hp, 'forgot');

	// 			$this->session->set_flashdata('message', '<div class="alert alert-success">Silahkan cek Pesan Whatsapp untuk mereset password</div> ');
	// 			redirect('auth');
	// 		} else {
	// 			$this->session->set_flashdata('message', '<div class="alert alert-danger">Email Tidak Terdaftar atau belum di aktivasi</div> ');
	// 			redirect('auth');
	// 		}
	// 	}
	// }



	public function _deleteUser($email)
	{
		$user = $this->db->get_where('user', ['is_active' => 0, 'email' => $email])->row_array();
		if (date('Y-m-d H:i:s') - $user['date_created'] < (60 * 60 * 24)) {
		} else {
			$this->db->delete('user', ['email' => $email]);
		}
	}
	public function resetPassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Reset password Gagal, Token salah</div> ');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Reset password Gagal, Email salah</div> ');
			redirect('auth');
		}
	}
	public function changePassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}
		$this->form_validation->set_rules(
			'password1',
			'Password',
			'trim|required|min_length[5]|matches[password2]'
		);
		$this->form_validation->set_rules(
			'password2',
			'Repeat Password',
			'trim|required|min_length[5]|matches[password1]'
		);

		if ($this->form_validation->run() == false) {
			if (!$this->agent->is_mobile()) {
				// Desktop View
				$data = [
					'title'		=> 'Change Password',
					'content'	=> 'front/auth/change_password'
				];
				$this->load->view('front/layout/wrapp', $data, FALSE);
			} else {
				// Mobile View
				$data = [
					'title'		=> 'Change Password',
					'content'	=> 'mobile/auth/change_password'
				];
				$this->load->view('mobile/layout/wrapp', $data, FALSE);
			}
		} else {
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->unset_userdata('reset_email');
			$this->session->set_flashdata('message', '<div class="alert alert-success">Password has been change</div> ');
			redirect('auth');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('id');
		$this->session->set_flashdata('message', '<div class="alert alert-success">Anda sudah Logout</div> ');
		if (!$this->agent->is_mobile()) {
			// Desktop View
			redirect('auth');
		} else {
			// Mobile View
			redirect('/');
		}
	}
}
