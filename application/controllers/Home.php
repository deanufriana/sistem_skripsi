<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Sistem Skripsi Online Berbasis Web
 * @version    1
 * @author     Devi Adi Nufriana | https://facebook.com/mysilkyheart
 * @copyright  (c) 2018
 * @email       deanheart09@gmail.com
 *
 * PERINGATAN :
 * 1. TIDAK DIPERKENANKAN MEMPERJUALBELIKAN APLIKASI INI TANPA SEIZIN DARI PIHAK PENGEMBANG APLIKASI.
 * 2. TIDAK DIPERKENANKAN MENGHAPUS KODE SUMBER APLIKASI.
 * 3. TIDAK MENYERTAKAN LINK KOMERSIL (JASA LAYANAN HOSTING DAN DOMAIN) YANG MENGUNTUNGKAN SEPIHAK.
 */

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->load->view('home');
	}

	function contoh()
	{
		$this->load->view('example');
	}

	function reset()
	{

		$this->load->view('reset');
	}

	public function Lupa()  
	{  

		$email = $this->input->post('email');   
		$clean = $this->security->xss_clean($email);  
		$where = array('email_mhs' =>  $clean);
		$userInfo = $this->M_data->getUserInfoByEmail('mahasiswa', $where);  

		if(!$userInfo){  
			$this->session->set_flashdata('sukses', 'email address salah, silakan coba lagi.');  
			redirect(site_url('home/lupa'),'refresh');   
		}    

		$token = $this->M_data->insertToken($userInfo->nim);              
		$qstring = $this->base64url_encode($token);           
		$url = base_url() . '/home/reset_password/token/' . $qstring;    

		$this->email->from('umusbrebes@gmail.com', 'Universitas Muhadi Setiabudi');
		$this->email->to($email);

		$this->email->subject('Lupa Password, ya?');
		$this->email->message('silahkan klik link di bawah ini untuk mereset passwordnya, misal ini bukan anda silahkan abaikan saja. '.$url);

		if ($this->email->send()) {
			echo 1;
		} else {
			echo 0;
		}
		
	}


	public function reset_password()  
	{  
		$token = $this->base64url_decode($this->uri->segment(4));           
		$cleanToken = $this->security->xss_clean($token);  

		$user_info = $this->M_data->isTokenValid($cleanToken);    

		if(!$user_info){  
			$this->session->set_flashdata('sukses', 'Token tidak valid atau kadaluarsa');  
			redirect(site_url('login'),'refresh');   
		}    

		$data = array(  
			'title'=> 'Halaman Reset Password | Tutorial reset password CodeIgniter @ https://recodeku.blogspot.com',  
			'nama'=> $user_info->nama_mhs,   
			'email'=>$user_info->email_mhs,   
			'token'=>$this->base64url_encode($token)  
		);  

		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');  
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');         

		if ($this->form_validation->run() == FALSE) {    
			$this->load->view('reset', $data);  
		}else{  

			$post = $this->input->post(NULL, TRUE);          
			$cleanPost = $this->security->xss_clean($post);          
			$hashed = md5($cleanPost['password']);          
			$cleanPost['password'] = $hashed;  
			$cleanPost['id_user'] = $user_info->nim;  
			unset($cleanPost['passconf']);          
			if(!$this->M_data->updatePassword($cleanPost)){  
				$this->session->set_flashdata('sukses', 'Update password gagal.');  
			}else{  
				$this->session->set_flashdata('sukses', 'Password anda sudah  
					diperbaharui. Silakan login.');  
			}  
			redirect(site_url('login'),'refresh');         
		}  
	}  

	public function base64url_encode($data) {   
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');   
	}   

	public function base64url_decode($data) {   
		return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));   
	}
	function pendaftaran()
	{
		$data['jurusan'] = $this->M_data->find('jurusan');
		$this->load->view('pendaftaran', $data);
	}

	function konsentrasi(){

		$id_fakultas = $this->input->post('id_fakultas');
		$where = array('id_jurusan_ksn' => $id_fakultas );
		$data = $this->M_data->find('konsentrasi', $where);
		$lists = "<option value=''>Pilih</option>";

		foreach($data->result() as $u){
			$lists .= "<option value='".$u->id."'>".$u->konsentrasi."</option>"; 
		}

		$callback = array('list'=> $lists); 
		echo json_encode($callback);
	}

	function mendaftar()
	{
		$nim = $this->input->post('nim');
		$nama = $this->input->post('nama');
		$jurusan = $this->input->post('jurusan');
		$konsentrasi = $this->input->post('konsentrasi');
		$nohp = $this->input->post('nohp');
		$email = $this->input->post('email');

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

				$data = array('nim' => $nim,
					'nama_mhs' => $nama,
					'id_jurusan_mhs' => $jurusan,
					'id_konsentrasi_mhs' => $konsentrasi,
					'nohp_mhs' => $nohp,
					'email_mhs' => $email, 
					'foto_mhs' => $foto['file_name'],
					'status' => 'daftar');

				$this->M_data->save($data, 'mahasiswa');

			}


		}	
		else {
			$this->load->view('pendaftaran');
		}

	}

	function session()
	{
		$username = $this->input->post('nim');
		$password = md5($this->input->post('password'));

		$where_mhs = "(nim='$username' OR email_mhs='$username') AND pwd_mhs='$password'";
		$where_dosen = "(nik='$username' OR email_dsn='$username') AND password='$password'";
		$where_admin = "username='$username' AND password='$password'";

		$dosen = $this->M_data->find('dosen', $where_dosen, '', '', '', '', 'konsentrasi', 'konsentrasi.id = dosen.id_konsentrasi_dsn', 'jurusan','jurusan.id_jurusan = dosen.id_jurusan_dsn');
		$mhs = $this->M_data->find('mahasiswa', $where_mhs, '', '', '', '', 'jurusan','jurusan.id_jurusan = mahasiswa.id_jurusan_mhs', 'konsentrasi', 'konsentrasi.id = mahasiswa.id_konsentrasi_mhs');
		$admin = $this->M_data->find('admin', $where_admin);

		if ($dosen->num_rows() > 0) {

			foreach ($dosen->result() as $u) {

				$data['nik'] = $u->nik;
				$data['nama_dosen'] = $u->nama_dosen;
				$data['password'] = $u->password;
				$data['nohp'] = $u->nohp_dsn;
				$data['email_dsn'] = $u->email_dsn;
				$data['foto'] = $u->foto_dsn;
				$data['id'] = $u->id;
				$data['konsentrasi'] = $u->konsentrasi;
				$data['jurusan'] = $u->jurusan;
				$data['nik_kaprodi'] = $u->nik_kaprodi;
				
				if ($u->nik === $u->nik_kaprodi) {
					$data['status'] ="Kaprodi";
					echo 3;
				} else {
					$data['status'] = "Dosen";
					echo 1;					
				}

				$this->session->set_userdata($data);

			}

		} else {

			if ($mhs->num_rows() > 0) {

				foreach ($mhs->result() as $a) {
					$data1['nim'] = $a->nim;
					$data1['nama_mhs'] = $a->nama_mhs;
					$data1['pwd_mhs'] = $a->pwd_mhs;
					$data1['jurusan'] = $a->jurusan;
					$data1['konsentrasi'] = $a->konsentrasi;
					$data1['id_skripsi_mhs'] = $a->id_skripsi_mhs;
					$data1['nohp_mhs'] = $a->nohp_mhs;
					$data1['email_mhs'] = $a->email_mhs;
					$data1['foto_mhs'] = $a->foto_mhs;
					$data1['status'] = "mahasiswa";


					if ($a->status === 'daftar') {
						echo 0;
					} else {
						$this->session->set_userdata($data1);
						echo 2;
					}

				}

			}  else {

				if ($admin->num_rows() > 0) {

					foreach ($admin->result() as $b) {

						$data2 = array(
							'username' => $b->username,
							'password' => $b->password,
							'status' => 'Admin'
						);
						
						$this->session->set_userdata( $data2 );
						echo 4;
					}
				} else {
					redirect('Home');
				}
			}

		}

	}

	public function Logout()
	{
		$this->session->sess_destroy();
		redirect('Home');
	}

	public function ambil()
	{
		$data = $this->M_data->ambil();
		if (!empty($data)) {
			foreach ($data as $d) {
				$json[] = array(
					'id_ide' => $d['id_ide'],
					'nim_mhs_ide' => $d['nim_mhs_ide'],
					'judul' => $d['judul'],
					'deskripsi' => $d['deskripsi'],
					'tanggal' => $d['tanggal']
				 );
			}		
		} else {
			$json = array();
		}

		echo json_encode($json);
	}
}
