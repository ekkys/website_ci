<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//cek session yang login
		//jika session status !=  telah_login artinya pengguna belum login
		// maka halaman akan dialihkan ke halaman login

		if ($this->session->userdata('status')  != "telah_login") {
			redirect(base_url('login?alert=belum_login'));
		}

	}

	public function index()
	{
		$this->load->view('dashboard/v_index');
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */