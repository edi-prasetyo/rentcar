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
				$data = [
					'title' 		=> 'User Login',
					'content'       => 'front/auth/login'
				];
				$this->load->view('front/layout/wrapp', $data, FALSE);
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
							redirect($_SERVER['HTTP_REFERER']);
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
			$data = [
				'title'			=> 'Register Reseller',
				'content'       => 'front/auth/register'
			];
			$this->load->view('front/layout/wrapp', $data, FALSE);
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
				'is_active'		=> 1,
				'is_locked'		=> 1,
				'date_created'	=> date('Y-m-d H:i:s')
			];
			//Token
			$token = base64_encode(random_bytes(25));
			$user_token = [
				'email'			=> $email,
				'token'			=> $token,
				'date_created'	=>  date('Y-m-d H:i:s')
			];
			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);
			//Kirim Email
			$this->_sendEmail($token, 'verify');
			$this->_deleteUser($email);

			$this->session->set_flashdata('message', '<div class="alert alert-success">Selamat Anda berhasil mendaftar, silahkan Aktivasi akun</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	private function _sendEmail($token, $type)
	{
		$meta = $this->meta_model->get_meta();
		$email_daftar = $this->pengaturan_model->email_register();
		$config = [

			'protocol'     	=> "$email_daftar->protocol",
			'smtp_host'   	=> "$email_daftar->smtp_host",
			'smtp_port'   	=> $email_daftar->smtp_port,
			'smtp_user'   	=> "$email_daftar->smtp_user",
			'smtp_pass'   	=> "$email_daftar->smtp_pass",
			'mailtype'     	=> 'html',
			'charset'     	=> 'utf-8',
		];

		$this->load->library('email', $config);
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$this->email->from("$email_daftar->smtp_user", $meta->title);
		$this->email->to($this->input->post('real_email'));

		if ($type == 'verify') {
			$this->email->subject('Account Verification');
			$this->email->message('Silahkan Klik Link ini untuk mengaktivasi akun 
			<a href=" ' . base_url() . 'auth/verify?email=' . $this->input->post('real_email') . '&token=' . urlencode($token) . ' ">Aktivasi</a>');
		} elseif ($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('Silahkan Klik Link ini untuk Mereset Password 
			<a href=" ' . base_url() . 'auth/resetpassword?email=' . $this->input->post('real_email') . '&token=' . urlencode($token) . ' ">Reset Password</a>');
		}

		if ($this->email->send()) {
			return true;
		}
	}
	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
			if ($user_token) {
				if (time() - $user_token['date_created'] < (60 * 60 * 24)) {

					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('user');

					$this->db->delete('user_token', ['email' => $email]);
					$this->session->set_flashdata('message', '<div class="alert alert-success">Selamat email ' . $email . '  sudah di aktivasi, Silahkan login!</div> ');
					redirect('auth');
				} else {
					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user', ['token' => $token]);
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Aktivasi akun Gagal, Token Expired!</div> ');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Aktivasi akun Gagal, Token salah!</div> ');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Aktivasi akun Gagal, Email salah!</div> ');
			redirect('auth');
		}
	}
	public function forgotPassword()
	{
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|trim|valid_email',
			[
				'required' 		=> 'Email harus di isi',
				'valid_email' 	=> 'Format email Tidak sesuai'
			]
		);
		if ($this->form_validation->run() == false) {
			$data = [
				'title'		=> 'Forgot Password',
				'content'	=> 'front/auth/forgot_password'
			];
			$this->load->view('front/layout/wrapp', $data, FALSE);
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
			if ($user) {
				$token = base64_encode(random_bytes(25));
				$user_token = [
					'email'			=> $email,
					'token'			=> $token,
					'date_created'	=> time()
				];
				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token, 'forgot');

				$this->session->set_flashdata('message', '<div class="alert alert-success">Silahkan cek email untuk mereset password</div> ');
				redirect('auth');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Email Tidak Terdaftar atau belum di aktivasi</div> ');
				redirect('auth');
			}
		}
	}
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
			$data = [
				'title'		=> 'Change Password',
				'content'	=> 'front/auth/change_password'
			];
			$this->load->view('front/layout/wrapp', $data, FALSE);
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
		redirect('auth');
	}
}
