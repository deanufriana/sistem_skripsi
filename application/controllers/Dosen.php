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

class Dosen extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$status = $this->session->userdata('status');
		if (!(($status == "Dosen") OR ($status == "Kaprodi"))) {
			redirect(base_url("Home"));
		}
	}

	function index()
	{
		$this->load->view('template/navbar');
		$this->load->view('dosen/home');
	}

	function beranda()
	{
		$where = array('penerima' => $this->session->userdata('nik'));
		$data['pemberitahuan'] = $this->M_data->find('pemberitahuan', $where, '', '', '', '', 'dosen', 'dosen.nik = pemberitahuan.pengirim');
		$this->load->view('dosen/home', $data);
	}

	function profil()
	{
		$where = array('nik' => $this->session->userdata('nik'));
		$data['dosen'] = $this->M_data->find('dosen',$where);
		$this->load->view('dosen/profil', $data);
	}


	function pemberitahuan()
	{
		$where = array('penerima' => $this->session->userdata('nik'));
		$data['pemberitahuan'] = $this->M_data->find('pemberitahuan', $where, '', '', '', '', 'dosen', 'dosen.nik = pemberitahuan.pengirim');
		$this->load->view('dosen/pemberitahuan', $data);
	}

	function tabel_skripsi()
	{
		$where = array('nik' => $this->session->userdata('nik'));
		$data['pembimbing'] = $this->M_data->find('pembimbing', $where, '', '', '', '', 'mahasiswa', 'mahasiswa.nim = pembimbing.nim_mhs_pmb', 'dosen', 'dosen.nik = pembimbing.nik_dsn_pmb', 'skripsi', 'skripsi.id_skripsi = pembimbing.id_skripsi_pmb');
		$this->load->view('dosen/tabel_skripsi', $data);	
	}

	function mhs_profil($id_pmb)
	{
		$this->load->view('template/navbar');
		$where = array('id_pmb' => $id_pmb);
		
		$data['pembimbing'] = $this->M_data->find('pembimbing', $where, '', '', '', '', 'skripsi', 'skripsi.id_skripsi = pembimbing.id_skripsi_pmb', 'mahasiswa', 'mahasiswa.nim = pembimbing.nim_mhs_pmb');
		
		foreach ($data['pembimbing']->result() as $c) {

			$nim = $c->nim;
			$prop = 'Disetujui';
			$where_prop = "nim_mhs_pmb='$nim' AND status_proposal='$prop'";

			$data['konsultasi'] = $this->M_data->find('konsultasi', '' ,'nim_mhs_ks', $nim);

			$data['prop'] = $this->M_data->find('pembimbing', $where_prop);

			$this->load->view('dosen/mhs_profil', $data);

		}
	}

	function accUsers($idPmb, $users)
	{
		$where['id_pmb'] = $idPmb;

		$cek['pembimbing'] = $this->M_data->find('pembimbing', $where, '', '', '', '', 'skripsi', 'skripsi.id_skripsi = pembimbing.id_skripsi_pmb', 'mahasiswa', 'mahasiswa.nim = pembimbing.nim_mhs_pmb');

		foreach ($cek['pembimbing']->result() as $c) {
			$data['pemberitahuan'] = $users.''.$c->judul_skripsi.' Telah Di ACC';
			$data['catatan'] = $users.' Telah Di ACC Oleh : <br>'.$this->session->userdata('nama_dosen').' Sebagai '.$c->level;
			$data['penerima'] = $c->nim;
			$data['pengirim'] = $this->session->userdata('nik');
			$data['tanggal'] = date('Y-m-d');
			$data['status'] = '<span class="text-right badge badge-info"> <i class="fas fa-info"></i> '.$users.' </span>';

			$accept['status_'.$users] = 'Disetujui';

			$this->M_data->update('id_pmb', $idPmb, 'pembimbing', $accept);
			$this->M_data->save($data, 'pemberitahuan'); 
		}
	}

	function catatan()
	{
		$data['tanggal'] = date('Y-m-d');
		$data['catatan'] = $this->input->post('note');
		$data['pembimbing'] = $this->session->userdata('nama_dosen');
		$data['nim_mhs_ks'] = $this->input->post('mhs');
		$this->M_data->save($data, 'konsultasi');
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