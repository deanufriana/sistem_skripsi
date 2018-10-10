<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Sistem Skripsi Online Berbasis Web
 * @version    1
 * @author     Devi Adi Nufriana | https://facebook.com/mysilkyheart
 * @copyright  (c) 2018
 * @email      deanheart09@gmail.com
 *
 * PERINGATAN :
 * 1. TIDAK DIPERKENANKAN MEMPERJUALBELIKAN APLIKASI INI TANPA SEIZIN DARI PIHAK PENGEMBANG APLIKASI.
 * 2. TIDAK DIPERKENANKAN MENGHAPUS KODE SUMBER APLIKASI.
 * 3. TIDAK MENYERTAKAN LINK KOMERSIL (JASA LAYANAN HOSTING DAN DOMAIN) YANG MENGUNTUNGKAN SEPIHAK.
 */

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != "Admin") {
			redirect(base_url("Home"));
		}
		$this->load->library('Ajax_pagination');
		$this->perPage = 2;
	}

	function index()
	{
		$this->load->view('template/navbar');
		$this->load->view('admin/home');
	}

	function navigasiUsers($nav)
	{
		$this->load->view('admin/nav'.$nav);
	}

	function formJurusan()
	{
		$this->load->view('admin/formJurusan');
	}

	function formKonsentrasi()
	{
		$data['jurusan'] = $this->M_data->find('jurusan');
		$where = array('Status' => 'Dosen');
		$data['users'] = $this->M_data->find('users', $where);
		$this->load->view('admin/formKonsentrasi', $data);
	}

	function formKaprodi($id)
	{
		$where = array('IDKonsentrasiUser' => $id);
		$data['dosen'] = $this->M_data->find('users', $where);
		$data['ID'] = $id;
		$this->load->view('admin/formKaprodi', $data);
	}

	function formDosen()
	{
		$data['jurusan'] = $this->M_data->find('jurusan');
		$this->load->view('admin/formDosen', $data);
	}

	function tabelJrsnAdmin()
	{ 
		$data['jurusan'] = $this->M_data->find('jurusan');
		$this->load->view('admin/tabelJrsnAdmin', $data);
	}

	function tabelKonsentrasiAdmin($id)
	{
		$where = array('IDJurusanKsn' => $id);
		
		$data['konsentrasi'] = $this->M_data->find('konsentrasi', $where, '', '', '', '', 'users', 'users.ID = konsentrasi.IDDosen');
		
		$data['users'] = $this->M_data->find('users');
		$this->load->view('admin/tabelKonsentrasiAdmin', $data);
	}

	function submitKaprodi($id)
	{
		$where = array(
			'IDKonsentrasi' => $id
		);

		$data['IDDosen'] = $this->input->post('kaprodi');
		
		$this->M_data->update('IDKonsentrasi', $id, 'konsentrasi', $data);
		redirect('Admin');
	}

	function tabelNavigasi($page, $user)
	{
		if (!$page) {
			$offset = 0;
		} else {
			$offset = $page;
		}

		$keywords = $this->input->post('keywords');
		$sortBy = $this->input->post('sortBy');
		$search = $this->input->post('search');


		if(!empty($keywords)){
			$conditions['search']['keywords'] = $keywords;
		}
		if(!empty($sortBy)){
			$conditions['search']['sortBy'] = $sortBy;
		}
		
		$conditions['start'] = $offset;
		$conditions['limit'] = $this->perPage;

		if ($user === 'Mahasiswa') {
			$where = "(Status='Mahasiswa' OR Status='Skripsi')";
		} else {
			$where['Status'] = $user;
		}

		$data['users'] = $this->M_data->find('users', $where, '', '', '', '', 'jurusan', 'jurusan.IDJurusan = users.IDJurusanUser', 'konsentrasi', 'konsentrasi.IDKonsentrasi = users.IDKonsentrasiUser', '', '', $conditions, $search);

		$total = $this->M_data->find('users', $where, '', '', '', '', 'jurusan', 'jurusan.IDJurusan = users.IDJurusanUser', 'konsentrasi', 'konsentrasi.IDKonsentrasi = users.IDKonsentrasiUser');

		$totalRec = $total->num_rows();

		$config['target']      = '#tabelUsers';
		$config['base_url']    = base_url().'Admin/tabelNavigasi/'.$page.'/'.$user;
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'search'.$user;
		$this->ajax_pagination->initialize($config);

		$this->load->view('admin/tabelUsers', $data, false);
	}

	function delete_dosen($nik)
	{
		$where = array('ID' => $nik);
		$cek = $this->M_data->find('users', $where);

		foreach ($cek->result() as $c) {
			unlink('./assets/images/User/'.$c->foto_dsn);
			$this->M_data->delete($where, 'users');
		}
	}

	function delete_jurusan($id)
	{
		$where = array('IDJurusan' => $id);
		$this->M_data->delete($where, 'jurusan');
	}

	function saveJurusan()
	{
		$data['IDJurusan'] = $this->input->post('id_jurusan');
		$data['Jurusan'] = $this->input->post('jurusan');

		$this->M_data->save($data, 'jurusan');
	}

	function saveKonsentrasi()
	{
		$data['IDKonsentrasi'] = $this->input->post('id');
		$data['konsentrasi'] = $this->input->post('konsentrasi');
		$data['IDJurusanKsn'] = $this->input->post('id_jurusan');
		$data['IDDosen'] = $this->input->post('prodi');
		$this->M_data->save($data, 'konsentrasi');
	}

	private function sendEmail($email, $nama, $password)
	{
		$this->email->from('umusbrebes@gmail.com', 'Universitas Muhadi Setiabudi');
		$this->email->to($email);

		$this->email->subject('Sistem Informasi Skripsi');
		$this->email->message('Selamat Datang '.$nama.' di Universitas Muhadi Setiabudi. Sekarang anda bisa login sistem informasi skripsi dengan menggunakan ID anda. Password : '.$password.'  Semoga harimu menyenangkan.');

		return $this->email->send();

	}

	function saveDosen() // Menyimpan Form Dosen
	{
		$nik = $this->input->post('nik');
		$nama = $this->input->post('nama_dosen');
		$nohp = $this->input->post('nohp');
		$email = $this->input->post('email');
		$jurusan = $this->input->post('id_jurusan');
		$konsentrasi = $this->input->post('konsentrasi');

		$filename = "file_".time('upload');

		$config['upload_path'] = './assets/images/User/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['file_name']	= $filename;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('foto'))
		{
			$error = array('error' => $this->upload->display_errors());
		} else {

			$foto = $this->upload->data();
			$password = random_string('alnum', 12);

			if ($this->sendEmail($email, $nama, $password)) {
				$data = array(
					'ID' => $nik,
					'Nama' => $nama,
					'Password' => md5($password),
					'NoHP' => $nohp,
					'Email' => $email, 
					'IDKonsentrasiUser' => $konsentrasi,
					'IDJurusanUser' => $jurusan, 
					'Foto' => $foto['file_name'],
					'Status' => 'Dosen'
				);

				$this->M_data->save($data, 'users');
				echo 1;

			} else {
				echo 'Terjadi Kesalahan Saat Mengirim Password Silahkan Cek Internet Anda Atau Hubungi Layanan Server';
			}

		}



	}

	function acceptDaftar($ID, $disetujui)
	{
		if ($disetujui) {

			$where = array('ID' => $ID);
			$users = $this->M_data->find('users', $where);

			$result = $users->row();

			$password = random_string('alnum', 8);
			
			if ($this->sendEmail($result->Email, $result->Nama, $password)) {

				$data['Password'] = $password;
				$data['Status'] = 'Mahasiswa';
				$this->M_data->update('ID', $ID, 'users', $data);

			} else {

				echo "Terjadi Kesalahan Saat Mengirim Password Silahkan Cek Internet Anda Atau Hubungi Layanan Server";

			}

		} else {

			$where = array('ID' => $ID);
			$cek = $this->M_data->find('users', $where);

			foreach ($cek->result() as $c) {
				if ($this->M_data->delete($where, 'users')) {
					unlink('./assets/images/User/'.$c->foto);
				}			
			}

		}
	}

	function filterKaprodi()
	{
		$id_jurusan = $this->input->post('id_jurusan');
		$where = array(
			'IDJurusanUser' => $id_jurusan,
			'Status' => 'Dosen'
		);
		$data = $this->M_data->find('users', $where);

		$lists ="<option value=''> Pilih Kaprodi </option>";

		foreach ($data->result() as $d) {
			$lists .= "<option value='".$d->ID."'>".$d->Nama."</option>";
		}
		$callback = array('list' => $lists);
		echo json_encode($callback);
	}

	function statusSkripsi($ID)
	{

		$data['Status'] = 'Skripsi';

		if (!$this->M_data->update('ID', $ID, 'users', $data)) {
			echo 0;
		} else {
			echo 1;
		}
		
	}

	function update(){
		$id= $this->input->post("id");
		$value= $this->input->post("value");
		$modul= $this->input->post("modul");
		$data[$modul] = $value;
		$this->M_data->update('ID', $id, 'users', $data);
		echo "{}";
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */