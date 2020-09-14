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

		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_index');
		$this->load->view('dashboard/v_footer');
	}

	public function keluar()
	{
		$this->session->sess_destroy();
		redirect('login?alert=logout');
	}

	public function ganti_password()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_ganti_password');
		$this->load->view('dashboard/v_footer');
	}

	public function ganti_password_aksi()
	{
		//form validasi
		$this->form_validation->set_rules('password_lama','Password Lama','required');
		$this->form_validation->set_rules('password_baru','Password Baru','required|min_length[8]');
		$this->form_validation->set_rules('konfirmasi_password','Konfirmasi Password Baru','required|matches[password_baru]');

		//cek validasi kesesuain password lama
		if ($this->form_validation->run() != false) {

			//menangkap data dari form
			$password_lama = $this->input->post('password_lama');
			$password_baru = $this->input->post('password_baru');
			$konfirmasi_password = $this->input->post('konfirmasi_password');

			//cek kesesuaian password lama dengan id pengguna yang sednag login
			$where = array(
				'pengguna_id' => $this->session->userdata('id') , 
				'pengguna_password' => md5($password_lama)
			);
			// mengecek keberadaan baris data user sesuai $where
			$cek = $this->m_data->cek_login('pengguna', $where)->num_rows();

			//cek kesesuaian password lama
			if ($cek > 0) {

				//update data password
				$w = array('pengguna_id' => $this->session->userdata('id'));

				$data = array('pengguna_password' => md5($password_baru));

				//update data ke database
				$this->m_data->update_data($w, $data, 'pengguna');

				//alihkan ke halaman ke halaman ganti password
				redirect('dashboard/ganti_password?alert=sukses');
			}else{
				//alihkan ke halaman ke halaman ganti password
				redirect('dashboard/ganti_password?alert=gagal');
			}


		}else{
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_ganti_password');
			$this->load->view('dashboard/v_footer');
		}
	}


//CRUF Kategori

	public function kategori()
	{
		//memanggil data dari database
		$data['kategori'] = $this->m_data->get_data('kategori')->result();
		//viewnya
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_kategori',$data);
		$this->load->view('dashboard/v_footer'); 
	}

	public function kategori_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_kategori_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function kategori_tambah_aksi()
	{

		$this->form_validation->set_rules('kategori','Kategori','required');
		

		if ($this->form_validation->run() != false) {
			
			//menampung input
			$kategori = $this->input->post('kategori');

			$data = array(
				'kategori_nama' => $kategori , 
				'kategori_slug' =>  strtolower(url_title($kategori))
			);

			//menyimpan ke database
			$this->m_data->insert_data($data, 'kategori');

			//alihkan ke kategori
			redirect('dashboard/kategori?alert=sukses');

		}else{
			//alihkan ke kategori
			redirect('dashboard/kategori?alert=gagal');
		}
	}

	public function kategori_edit($id)
	{
		//menampung id
		$where = array('kategori_id' => $id );

		//menampilkan data sesuai id
		$data['kategori'] = $this->m_data->edit_data($where,'kategori')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_kategori_edit',$data);
		$this->load->view('dashboard/v_footer');

	}

	public function kategori_update()
	{
		$this->form_validation->set_rules('kategori','Kategori','required');

		if ($this->form_validation->run() != false) {
			
			//menampung inputan
			$id = $this->input->post('id');
			$kategori = $this->input->post('kategori');

			$where = array('kategori_id' => $id );

			$data = array(
				'kategori_nama' => $kategori , 
				'kategori_slug' => strtolower(url_title($kategori))  
			);

			//update ke db
			$this->m_data->update_data($where, $data, 'kategori');

			//alihkan ke dashboard kategori
			redirect('dashboard/kategori?alert=sukses');
		}else{
			
			//alihkan ke dashboard kategori
			$id = $this->input->post('id');
			$where = array(
				'kategori_id' => $id
			);

			$data['kategori'] = $this->m_data->edit_data($where,'kategori')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_kategori_edit?alert=gagal',$data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function kategori_hapus($id)
	{
		//menampung id
		$where = array('kategori_id' => $id );

		$hapus = $this->m_data->delete_data($where, 'kategori');

		redirect('dashboard/kategori?alert=sukses_hapus');
		
	}
	//Akhir CRUD Kategori


	//CRUD Artikel
	public function artikel()
	{
		// mengambil data dari db
		$data['artikel'] = $this->db->query("SELECT * FROM artikel,kategori,pengguna WHERE artikel_kategori=kategori_id AND 
			artikel_author=pengguna_id ORDER BY artikel_id DESC")->result();
		//view
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_artikel',$data);
		$this->load->view('dashboard/v_footer');
	}

	//Akhir CRUD Artikel

	public function artikel_tambah()
	{
		//mengambil data kategori dari db
		$data['kategori'] = $this->m_data->get_data('kategori')->result();

		//vienya
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_artikel_tambah',$data);
		$this->load->view('dashboard/v_footer');

	}

	public function artikel_aksi()
	{
		//Wajib isi judul, konten, dan kaetgori
		$this->form_validation->set_rules('judul','Judl','required|is_unique[artikel.artikel_judul]');
		$this->form_validation->set_rules('konten','Konten','required');
		$this->form_validation->set_rules('kategori','Kategori','required');

		//Membuat gambar wajib diisi
		if (empty($_FILES['sampul']['name'])) {
			$this->form_validation->set_rules('sampul', 'Gambar Sampul', 'required');
		}


		if($this->form_validation->run() != false) {

			//upload Gambar

			//lokasi dan jenis gmanbar
			$config['upload_path'] = './gambar/artikel';
			$config['allowed_types'] = 'gif|jpg|png';

			$this->load->library('upload', $config);

			if($this->upload->do_upload('sampul')){

				//mengambil data tentang gambar
				$gambar = $this->upload->data();

				$tanggal = date('Y-m-d H:i:s');
				$judul = $this->input->post('judul');
				$slug= strtolower(url_title($judul));
				$konten =  $this->input->post('konten');
				$sampul = $gambar['file_name'];
				$author = $this->session->userdata('id');
				$kategori = $this->input->post('kategori');
				$status = $this->input->post('status');

				//'nama_kolom_di_db' => $variable / menampung data yg di arraykan
				$data = array(
					'artikel_tanggal' => $tanggal , 
					'artikel_judul' => $judul, 
					'artikel_slug' => $slug, 
					'artikel_konten' => $konten, 
					'artikel_sampul' => $sampul, 
					'artikel_author' => $author, 
					'artikel_kategori' => $kategori , 
					'artikel_status' => $status  
				);
				//insert ke db
				$this->m_data->insert_data($data, 'artikel');
				//alih halman + notif
				redirect('dashboard/artikel');

			}else{
				echo '<h1>GAK MASUK DB COY</h1>' ;

				$this->form_validation->set_message('sampul',$data['gambar_error'] = $this->upload->display_errors());

				$data['kategori'] = $this->m_data->get_data('kategori')->result();
				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/v_artikel_tambah',$data);
				$this->load->view('dashboard/v_footer');
			}

		}else{
			$data['kategori'] = $this->m_data->get_data('kategori')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_artikel_tambah',$data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function artikel_edit($id)
	{
		// menangkap id
		$where = array(
			'artikel_id' => $id
		);

		// menampilkan data berdasarkan id
		$data['artikel'] = $this->m_data->edit_data($where, 'artikel')->result();
		$data['kategori'] = $this->m_data->get_data('kategori')->result();


		// ini viewnya
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_artikel_edit',$data);
		$this->load->view('dashboard/v_footer');


	}

	public function artikel_update()
	{
		//Isi judul, konten, dan kategori wajib di isi
		$this->form_validation->set_rules('judul','Judul','required');
		$this->form_validation->set_rules('konten','Konten','required');
		$this->form_validation->set_rules('kategori','Kategori','required');

		//jika form terisi sesuai syarat / tidak false = benar
		if ($this->form_validation->run() != false) {
			
			//menangkap id
			$id = $this->input->post('id');

			//data yang di post (mau diupdate)
			$judul = $this->input->post('judul');
			$slug = strtolower(url_title($judul));
			$konten = $this->input->post('konten');
			$kategori = $this->input->post('kategori');
			$status = $this->input->post('status');

			//id dijadikan where
			$where  = array(
				'artikel_id' => $id 
			);

			//ini data yang mau di update dijadikan array
			$data = array(
				'artikel_judul' => $judul,
				'artikel_slug' => $slug,
				'artikel_konten' => $konten,
				'artikel_kategori' => $kategori,
				'artikel_status' => $status,
			);

					//update by database
			$this->m_data->update_data($where, $data, 'artikel');

					//kondisi jika gambar ada isinya
			if (!empty($_FILES['sampul']['name'])) {

						//update gambar
				$config['upload_path']='./gambar/artikel/';
				$config['allowed_types']='gif|jpg|png';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('sampul')) {

							//mengambil data tentang gambar
					$gambar = $this->upload->data();

					$data = array(
						'artikel_sampul'=>$gambar['file_name']
					);

					$this->m_data->update_data($where, $data, 'artikel');

					redirect('dashboard/artikel');

				}else{

					$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->display_errors());

					$where  = array('artikel_id' => $id );

							//menampilkan data berdasarkan id ($where)
					$data['artikel'] = $this->m_data->edit_data($where, 'artikel')->result();
					$data['kategori'] = $this->m_data->get_data('kategori')->result();

					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_artikel_edit',$data);
					$this->load->view('dashboard/v_footer');
				}

			}else{
						//kondisijika gambar tidak ada isinya
				redirect('dashboard/artikel');
			}


		}else{

			//jika form validation going wrong 
			$id = $this->input->post('id');
			$where = array('artikel_id' => $id );

			//memanggil data dari database
			$data['artikel'] = $this->m_data->edit_data($where,'artikel')->result();
			$data['kategori'] = $this->m_data->get_data('kategori')->result();

			//tampilkan di sini 
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_artikel_edit',$data);
			$this->load->view('dashboard/v_footer');

		}


	}

	public function artikel_hapus($id)
	{
		//id data yang mau dihapus
		$where = array(
			'artikel_id' => $id
		);
		//hapus by id from db
		$this->m_data->delete_data($where,'artikel');
		redirect('dashboard/artikel','refresh');
	}
// AKHIR CRUD ARTIKEL


//CRUD PAGES
	public function pages()
	{
		$data['halaman'] = $this->m_data->get_data('halaman')->result();

		//viewnya
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pages',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function pages_aksi()
	{
		# code...
	}
} 

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */