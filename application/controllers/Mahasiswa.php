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

class Mahasiswa extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$status = $this->session->userdata('Status');
		if (!(($status == "Mahasiswa") OR ($status == "Skripsi"))) {
			redirect(base_url("Home"));
		}
	}

	function index()
	{
		$where = array('IDPenerima' => $_SESSION['ID']);
		$skrip = array('IDMahasiswaSkripsi' => $_SESSION['ID']);
		$data['pemberitahuan'] = $this->M_data->find('notifikasi', $where, '', '', 'IDNotifikasi', 'DESC', 'users','users.ID = Notifikasi.IDPengirim');

		$data['skripsi'] = $this->M_data->find('skripsi', $skrip);
		$this->load->view('template/navbar')->view('mahasiswa/home', $data);
	}

	function pengajuan()
	{
		$id_ide = time(); 
		$judul = $this->input->post('judul');
		$deskripsi = $this->input->post('deskripsi');
		$tanggal = longdate_indo(date('Y-m-d'));
		$nim = $_SESSION['ID'];

		$ide = array('IDIde' => $id_ide, 'IDIdeMahasiswa' => $nim, 'JudulIde' => $judul, 'DeskripsiIde' => $deskripsi, 'Tanggalide' => $tanggal);

		$where = array('JudulSkripsi' => $judul);

		$skripsi = $this->M_data->find('skripsi', $where);

		if ($skripsi->num_rows() > 0) {
			echo 1;
		} else {
			$this->M_data->save($ide, 'ideskripsi');
		}
	}

	function form_ide()
	{
		$this->load->view('mahasiswa/formIde');
	}

	function ideSkripsi()
	{
		$where = array('IDIdeMahasiswa' => $_SESSION['ID']);
		$data['ide_skripsi'] = $this->M_data->find('ideskripsi', $where, '', '', 'IDIde', 'DESC');

		$this->load->view('mahasiswa/ideSkripsi', $data);
	}

	function konsultasi()
	{
		$data['skripsi'] = $this->M_data->find('skripsi', '', 'IDMahasiswaSkripsi', $_SESSION['ID'], '', '', 'users', 'users.ID = skripsi.IDSkripsi');
		
		$data['konsultasi'] = $this->M_data->find('kartubimbingan', '', 'IDKartuMahasiswa', $_SESSION['ID'], '', '', 'users', 'users.ID = kartubimbingan.IDKartuMahasiswa');

		$nim = $_SESSION['ID'];
		
		foreach ($data['skripsi']->result() as $s) {
			$proposal = true;	
			$ID = $s->IDSkripsi;
			$where = array(
				'IDSkripsiPmb' => $ID,
				'StatusProposal' => $proposal
			);
			$data['pmb'] = $this->M_data->find('pembimbing', $where);

		}
		
		foreach ($data['skripsi']->result() as $m) {
			$data['pembimbing'] = $this->M_data->find('pembimbing','', 'IDSkripsiPmb', $m->IDSkripsi, '', '', 'users' ,'users.ID = pembimbing.IDDosenPmb');
		}
		
		$this->load->view('mahasiswa/mySkripsi', $data);
	}

	function update(){
		$id= $this->input->post("id");
		$value= $this->input->post("value");
		$modul= $this->input->post("modul");
		$data[$modul] = $value;
		$this->M_data->update('ID', $id, 'mahasiswa', $data);
		echo "{}";
	}

	function uploadData($sesi, $ID) {
		$filename = "file_".time('upload');
		$level = $this->session->userdata('File'.$sesi);

		$config['upload_path'] = './assets/'.$sesi.'/';
		$config['allowed_types'] = 'pdf';
		$config['file_name'] = $filename;

		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload($sesi)){
			$error = array('error' => $this->upload->display_errors());
			echo var_dump($error);

		} else {
			if (empty($level)) {
				echo 0;
			} else {
				unlink('./assets/'.$sesi.'/'.$level);
			}

			$file = $this->upload->data();
			$data = array('File'.$sesi =>  $file['file_name']);

			$this->M_data->update('IDSkripsi', $ID, 'skripsi', $data);
			echo "Berhasil";
		}
	}

}