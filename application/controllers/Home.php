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
				'status' => 'daftar'
			);

			$this->M_data->save($data, 'mahasiswa');

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

				$data = array(
					'nik' => $u->nik,
					'nama_dosen' => $u->nama_dosen,
					'nohp' => $u->nohp_dsn,
					'email_dsn' => $u->email_dsn,
					'foto' => $u->foto_dsn,
					'id' => $u->id,
					'konsentrasi' => $u->konsentrasi,
					'jurusan' => $u->jurusan,
					'nik_kaprodi' => $u->nik_kaprodi
				);		
				
				if ($u->nik === $u->nik_kaprodi) {
					$data['status'] ="Kaprodi";
					echo 3;
				} else {
					$data['status'] = "Dosen";
					echo 1;					
				}

				$this->session->set_userdata($data);

			}

		} elseif ($mhs->num_rows() > 0) {
			
			foreach ($mhs->result() as $a) {
				$data = array(
					'nim' => $a->nim,
					'nama_mhs' => $a->nama_mhs,
					'pwd_mhs' => $a->pwd_mhs,
					'jurusan' => $a->jurusan,
					'konsentrasi' => $a->konsentrasi,
					'id_skripsi_mhs' => $a->id_skripsi_mhs,
					'nohp_mhs' => $a->nohp_mhs,
					'email_mhs' => $a->email_mhs,
					'foto_mhs' => $a->foto_mhs,
					'file_proposal' => $a->file_proposal,
					'file_skripsi' => $a->file_skripsi,
					'status' => 'mahasiswa',
				);

				if ($a->status === 'daftar') {
					echo 0;
				} else {
					$this->session->set_userdata($data);
					echo 2;
				}
			} 
		} elseif ($admin->num_rows() > 0) {

			foreach ($admin->result() as $b) {

				$data = array(
					'id_admin' => $b->id_admin,
					'username' => $b->username,
					'password' => $b->password,
					'status' => 'Admin',
				);

				$this->session->set_userdata($data);
				echo 4;
			}
		} else {
			redirect('Home');
		}
	}

	public function Logout()
	{
		$this->session->sess_destroy();
		redirect('Home');
	}
}
