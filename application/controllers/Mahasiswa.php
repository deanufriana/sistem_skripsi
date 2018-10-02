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

	private $konsul = 'konsultasi';
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != "mahasiswa") {
			redirect(base_url("Home"));
		}
		
		
	}

	function index()
	{
		$where = array('penerima' => $this->session->userdata('nim'));
		$data['pemberitahuan'] = $this->M_data->find('pemberitahuan', $where, '', '', 'id', 'DESC', 'dosen','dosen.nik = pemberitahuan.pengirim');
		$data['mahasiswa'] = $this->M_data->find('mahasiswa', '', 'nim', $this->session->userdata('nim'));
		$this->load->view('template/navbar')->view('mahasiswa/home',$data);
	}

	function myprofil()
	{
		$data['mahasiswa'] = $this->M_data->find('mahasiswa', '', 'nim', $this->session->userdata('nim'));
		$this->load->view('mahasiswa/myProfil', $data);
	}

	function pemberitahuan()
	{
		$where = array('penerima' => $this->session->userdata('nim'));
		$data['pemberitahuan'] = $this->M_data->find('pemberitahuan', $where, '', '', 'id', 'DESC', 'dosen','dosen.nik = pemberitahuan.pengirim');
		$this->load->view('mahasiswa/pemberitahuan', $data);
	}

	function pengajuan()
	{
		$id_ide = time(); 
		$judul = $this->input->post('judul');
		$deskripsi = $this->input->post('deskripsi');
		$tanggal = longdate_indo(date('Y-m-d'));
		$nim = $this->session->userdata('nim');

		$ide = array('id_ide' => $id_ide, 'nim_mhs_ide' => $nim, 'judul' => $judul, 'deskripsi' => $deskripsi, 'tanggal' => $tanggal);

		$where = array('judul_skripsi' => $judul);

		$skripsi = $this->M_data->find('skripsi', $where);

		if ($skripsi->num_rows() > 0) {
			echo 1;
		} else {
			$this->M_data->save($ide, 'ide_skripsi');
		}
	}

	function form_ide()
	{
		$this->load->view('mahasiswa/formIde');
	}

	function ide_skripsi()
	{
		$where = array('nim_mhs_ide' => $this->session->userdata('nim'));
		$data['ide_skripsi'] = $this->M_data->find('ide_skripsi', $where, '', '', 'id_ide', 'DESC');

		$this->load->view('mahasiswa/ideSkripsi', $data);
	}

	function konsultasi()
	{
		$data['skripsi'] = $this->M_data->find('skripsi', '', 'nim_mhs_skripsi', $this->session->userdata('nim'), '', '', 'mahasiswa', 'mahasiswa.id_skripsi_mhs = skripsi.id_skripsi');
		
		$data['konsultasi'] = $this->M_data->find('konsultasi', '', 'nim_mhs_ks', $this->session->userdata('nim'));

		$nim = $this->session->userdata('nim');
		$proposal = 'Disetujui';

		$where = "nim_mhs_pmb='$nim' AND status_proposal='$proposal'";

		$data['pmb'] = $this->M_data->find('pembimbing', $where);

		
		$mahasiswa = $this->M_data->find('mahasiswa', '', 'nim', $this->session->userdata('nim'));
		foreach ($mahasiswa as $m) {
			$data['pembimbing'] = $this->M_data->find('pembimbing','', 'id_skripsi', $m->id_skripsi_mhs, '', '', 'mahasiswa' ,'mahasiswa.nim = pembimbing.nim_mhs_pmb', 'skripsi', 'skripsi.id_skripsi = pembimbing.id_skripsi_pmb', 'dosen', 'dosen.nik = pembimbing.nik_dsn_pmb');
		}
		
		$this->load->view('mahasiswa/mySkripsi', $data);
	}

	function update(){
		$id= $this->input->post("id");
		$value= $this->input->post("value");
		$modul= $this->input->post("modul");
		$data[$modul] = $value;
		$this->M_data->update('nim', $id, 'mahasiswa', $data);
		echo "{}";
	}

	function uploadData($sesi) {
		$filename = "file_".time('upload');
		$nim = $this->session->userdata('nim');
		$level = $this->session->userdata('file_'.$sesi);

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
			$data = array('file_'.$sesi =>  $file['file_name']);

			$this->M_data->update('nim', $nim, 'mahasiswa', $data);
			echo "Berhasil";
		}
	}

}