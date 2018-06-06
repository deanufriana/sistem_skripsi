<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	private $table = 'mahasiswa';
	private $dsn = 'dosen';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != "Admin") {
			redirect(base_url("Home"));
		}
		$this->load->library('Ajax_pagination');
		$this->perPage = 3;
	}

	public function index()
	{
		$this->load->view('template/navbar');
		$this->load->view('admin/home');
	}

	function tabel_jrsn_admin()
	{ 
		$data['jurusan'] = $this->M_data->find('jurusan');
		$this->load->view('admin/tabel_jrsn_admin', $data);
	}

	function tabel_konsentrasi_admin($id)
	{
		$where = array('id_jurusan_ksn' => $id);
		$data['konsentrasi'] = $this->M_data->find('konsentrasi', $where, '', '', '', '', 'dosen', 'dosen.nik = konsentrasi.nik_kaprodi');
		$data['dosen'] = $this->M_data->find('dosen');
		$this->load->view('admin/tabel_konsentrasi_admin', $data);
	}

	function form_konsentrasi() // Menampilkan Form Konsentrasi
	{
		$data['jurusan'] = $this->M_data->find('jurusan');
		$data['dosen'] = $this->M_data->find('dosen');
		$this->load->view('admin/form_konsentrasi', $data);
	}

	function save_konsentrasi()
	{
		$data['id'] = $this->input->post('id');
		$data['konsentrasi'] = $this->input->post('konsentrasi');
		$data['id_jurusan_ksn'] = $this->input->post('id_jurusan');
		$data['nik_kaprodi'] = $this->input->post('prodi');
		$this->M_data->save($data, 'konsentrasi');
	}

	function form_kaprodi($id)
	{
		$where = array('id' => $id);
		$data['konsentrasi'] = $this->M_data->find('konsentrasi', $where);
		$data['dosen'] = $this->M_data->find('dosen', '', 'id_konsentrasi_dsn', $id);
		$this->load->view('admin/form_kaprodi', $data);
	}

	function submit_kaprodi($id)
	{
		$where = array('id' => $id);
		$data['nik_kaprodi'] = $this->input->post('kaprodi');
		$this->M_data->update('id', $id, 'konsentrasi', $data);
		redirect('Admin');
	}

	function nav_mhs()
	{
		$this->load->view('admin/nav_mhs');
	}

	function nav_dsn()
	{
		$this->load->view('admin/nav_dsn');
	}

	function tabel_mhs_admin()
	{
		$page_mhs = $this->input->post('page');
		if(!$page_mhs){
			$offset = 0;
		}else{
			$offset = $page_mhs;
		}

		//set conditions for search
		$keywords_mhs = $this->input->post('keywords_mhs');
		$sortBy_mhs = $this->input->post('sortBy_mhs');
		$cari_mhs = $this->input->post('cari_mhs');


		if(!empty($keywords_mhs)){
			$conditions['search']['keywords'] = $keywords_mhs;
		}
		if(!empty($sortBy_mhs)){
			$conditions['search']['sortBy'] = $sortBy_mhs;
		}

        //Menghitung Keseluruaan 
		$totalRec = count($this->M_data->find('mahasiswa', '', 'status <>', 'daftar'));

        //Mengkofigurasi Pagination
		$config['target']      = '#tabel_mhs_admin';
		$config['base_url']    = base_url().'Admin/page_mhs';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'cari_mhs';
		$this->ajax_pagination->initialize($config);

		$conditions['start'] = $offset;
		$conditions['limit'] = $this->perPage;

        //get the posts data
		$data['mhs'] = $this->M_data->find('mahasiswa', '', 'status <>', 'daftar', '', '', 'jurusan', 'jurusan.id_jurusan = mahasiswa.id_jurusan_mhs', 'konsentrasi', 'konsentrasi.id = mahasiswa.id_konsentrasi_mhs', '', '', $conditions, $cari_mhs );

        //load the view
		$this->load->view('admin/tabel_mhs_admin', $data, false);
	}

	function tabel_mhs_daftar()
	{
		$page_mhs = $this->input->post('page');
		if(!$page_mhs){
			$offset = 0;
		}else{
			$offset = $page_mhs;
		}

		//set conditions for search
		$keywords_mhs = $this->input->post('keywords_mhs');
		$sortBy_mhs = $this->input->post('sortBy_mhs');
		$cari_mhs = $this->input->post('cari_mhs');


		if(!empty($keywords_mhs)){
			$conditions['search']['keywords'] = $keywords_mhs;
		}
		if(!empty($sortBy_mhs)){
			$conditions['search']['sortBy'] = $sortBy_mhs;
		}

        //Menghitung Keseluruaan 
		$totalRec = count($this->M_data->find('mahasiswa', '', 'status', 'daftar'));

        //Mengkofigurasi Pagination
		$config['target']      = '#tabel_mhs_daftar';
		$config['base_url']    = base_url().'Admin/page_daftar_mhs';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'search_daftar';
		$this->ajax_pagination->initialize($config);

		$conditions['start'] = $offset;
		$conditions['limit'] = $this->perPage;

        //get the posts data
		$data['mhs'] = $this->M_data->find('mahasiswa', '', 'status', 'daftar', '', '', 'jurusan', 'jurusan.id_jurusan = mahasiswa.id_jurusan_mhs', 'konsentrasi', 'konsentrasi.id = mahasiswa.id_konsentrasi_mhs', '', '', $conditions, $cari_mhs );

        //load the view
		$this->load->view('admin/tabel_mhs_daftar', $data, false);
	}

	function tabel_dsn_admin()
	{
		$page = $this->input->post('page');
		if (!$page) {
			$offset = 0;
		} else {
			$offset = $page;
		}

		$keywords_dsn = $this->input->post('keywords_dsn');
		$sortBy_dsn = $this->input->post('sortBy_dsn');
		$cari_dsn = $this->input->post('cari_dsn');

		if(!empty($keywords_dsn)){
			$conditions['search']['keywords'] = $keywords_dsn;
		}
		if(!empty($sortBy_dsn)){
			$conditions['search']['sortBy'] = $sortBy_dsn;
		}

		$totalRec = count($this->M_data->find('dosen'));

		$config['target']      = '#tabel_dsn_admin';
		$config['base_url']    = base_url().'Admin/tabel_dsn_admin';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'cari_dsn';
		$this->ajax_pagination->initialize($config);

		$conditions['start'] = $offset;
		$conditions['limit'] = $this->perPage;

		$data['dosen'] = $this->M_data->find('dosen', '', '', '', '', '', 'jurusan', 'jurusan.id_jurusan = dosen.id_jurusan_dsn', 'konsentrasi', 'konsentrasi.id = dosen.id_konsentrasi_dsn', '', '',$conditions, $cari_dsn);

		$this->load->view('admin/tabel_dsn_admin', $data, false);
	}

	function form_dosen()
	{
		$data['jurusan'] = $this->M_data->find('jurusan');
		$this->load->view('admin/form_dosen', $data);
	}

	function delete_dosen($nik)
	{
		$where = array('nik' => $nik);
		$cek = $this->M_data->find('dosen', $where);

		foreach ($cek->result() as $c) {
			unlink('./assets/images/'.$c->foto_dsn);
			$this->M_data->delete($where, 'dosen');
		}
	}

	function delete_jurusan($id)
	{
		$where = array('id_jurusan' => $id);
		$this->M_data->delete($where, 'jurusan');
	}

	function form_jurusan()
	{
		$this->load->view('admin/form_jurusan');
	}

	function save_jurusan()
	{
		$data['id_jurusan'] = $this->input->post('id_jurusan');
		$data['jurusan'] = $this->input->post('jurusan');

		$this->M_data->save($data, 'jurusan');
	}

	function filter_kaprodi()
	{
		$id_jurusan = $this->input->post('id_jurusan');
		$where = array('id_jurusan_dsn' => $id_jurusan);
		$data = $this->M_data->find('dosen', $where);

		$lists ="<option value=''> Pilih Kaprodi </option>";

		foreach ($data->result() as $d) {
			$lists .= "<option value='".$d->nik."'>".$d->nama_dosen."</option>";
		}
		$callback = array('list' => $lists);
		echo json_encode($callback);
	}

	function save_dosen() // Menyimpan Form Dosen
	{
		$nik = $this->input->post('nik');
		$nama = $this->input->post('nama_dosen');
		$nohp = $this->input->post('nohp');
		$email = $this->input->post('email');
		$jurusan = $this->input->post('id_jurusan');
		$konsentrasi = $this->input->post('konsentrasi');

		$filename = "file_".time('upload');

		$config['upload_path'] = './assets/images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['file_name']	= $filename;

		$this->load->library('upload', $config);

		if ($_FILES['foto']['name']){

			if ( ! $this->upload->do_upload('foto'))

			{
				$error = array('error' => $this->upload->display_errors());

			}
			else {

				$foto = $this->upload->data();
				$password = random_string('alnum', 12);

				$this->email->from('umusbrebes@gmail.com', 'Universitas Muhadi Setiabudi');
				$this->email->to($email);

				$this->email->subject('Sistem Informasi Skripsi');
				$this->email->message('Selamat Datang Dosen '.$nama.' di Universitas Muhadi Setiabudi.\n Sekarang anda bisa login sistem informasi skripsi dengan menggunakan nik ataupun email anda. \n Password : '.$password.' \n Semoga harimu menyenangkan.');
				
				if ($this->email->send()) {
					
					$data = array(
						'nik' => $nik,
						'nama_dosen' => $nama,
						'password' => md5($password),
						'nohp_dsn' => $nohp,
						'email_dsn' => $email, 
						'id_konsentrasi_dsn' => $konsentrasi,
						'id_jurusan_dsn' => $jurusan, 
						'foto_dsn' => $foto['file_name']
					);

					$this->M_data->save($data, 'dosen');

				} else {

					echo 0;

				}
				
			}

		} else {
			$this->load->view('pendaftaran');
		}

	}

	function submit_daftar($nim) // 
	
	{

		$data['status'] = 'Mahasiswa';

		$this->M_data->update('nim', $nim, 'mahasiswa', $data);
	}


	function status($nim) // Mengubah Status Mahasiswa
	{
		$this->load->library('ciqrcode');

		$config['cacheable']    = true; 
		$config['cachedir']     = './assets/'; 
		$config['errorlog']     = './assets/'; 
		$config['imagedir']     = './assets/images/'; 
		$config['quality']      = true; 
		$config['size']         = '1024'; 
		$config['black']        = array(224,255,255); 
		$config['white']        = array(70,130,180); 
		$this->ciqrcode->initialize($config);

		$get['mahasiswa'] = $this->M_data->find('mahasiswa', '', 'nim', $nim);

		foreach ($get['mahasiswa'] as $m) {
			$image_name = $m->nim.'.png';

			$params['data'] = base_url('Cetak/kartu/'.$m->nim);
			$params['level'] = 'H';
			$params['size'] = 10;
			$params['savename'] =FCPATH.$config['imagedir'].$image_name;

			$this->ciqrcode->generate($params);

			$this->email->from('umusbrebes@gmail.com', 'Universitas Muhadi Setiabudi');
			$this->email->to($m->email_mhs);

			$password = random_string('alnum', 8);

			$this->email->subject('Sistem Informasi Skripsi');
			$this->email->message('Persyaratan untuk melakukan skripsi telah dipenuhi silahkan login menggunakan nim anda dan password '.$password.' Jangan Pernah Membagikan Password Pada Siapapun');

			if ($this->email->send()) {

				$data['QR_Code'] = $image_name;
				$data['status'] = 'Skripsi';
				$data['pwd_mhs'] = md5($password);

				$this->M_data->update('nim', $nim, 'mahasiswa', $data);
				echo 1;
			} else {
				echo 0;
			}


		}
	}

	function pengaturan() // Halaman Pengaturan
	{
		$this->load->view('admin/pengaturan');
	}

	function submit_pwd()
	{
		$id = $this->session->userdata('id_admin');
		$where = array('id_admin' => $id);
		$pass_lama = $this->input->post('pass_lama');

		$data['password'] = md5($this->input->post('pass_baru'));
		$data['username'] = $this->input->post('username');

		$cek = $this->M_data->find('admin', $where);

		foreach ($cek->result() as $c) {

			$pass = $c->password;

			if (md5($pass_lama) === $pass) {
				$this->M_data->update('id_admin', $id, 'admin', $data);
				echo 1;
			} else {
				echo 0;
			}
		}
	}

	function update(){
		$id= $this->input->post("id");
		$value= $this->input->post("value");
		$modul= $this->input->post("modul");
		$data[$modul] = $value;
		$this->M_data->update('nik', $id, 'dosen', $data);
		echo "{}";
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */