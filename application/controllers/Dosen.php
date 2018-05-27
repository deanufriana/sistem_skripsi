<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
		$this->load->view('dosen/home');
	}

	function profil()
	{
		$this->load->view('dosen/profil');
	}

	function update_password()
	{
		$nik = $this->session->userdata('nik');
		$data = array('password' => md5($this->input->post('pass_baru')));
		$pass_lama = md5($this->input->post('pass_lama'));
		$where = array('nik' => $nik);

		$cek = $this->M_data->find('dosen', $where);

		foreach ($cek->result() as $c) {
			$pass = $c->password;

			if ($pass === $pass_lama) {
				$this->M_data->update('nik', $nik, 'dosen', $data);
				echo 1;
			} else {
				echo 0;
			}	

		}
	}

	function hapus_pemberitahuan($id)
	{
		$where = array('id' => $id);
		$this->M_data->delete($where, 'pemberitahuan');
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
		$where = array('id_pmb' => $id_pmb,);
		
		$data['pembimbing'] = $this->M_data->find('pembimbing', $where, '', '', '', '', 'skripsi', 'skripsi.id_skripsi = pembimbing.id_skripsi_pmb', 'mahasiswa', 'mahasiswa.nim = pembimbing.nim_mhs_pmb');
		
		foreach ($data['pembimbing']->result() as $c) {

			$nim = $c->nim; 

			$data['konsultasi'] = $this->M_data->find('konsultasi', '' ,'nim_mhs_ks', $nim);

			$this->load->view('dosen/mhs_profil', $data);

		}
	}


	function acc_proposal($id_pmb)
	{
		$where = array('id_pmb' => $id_pmb,);
		
		$cek['pembimbing'] = $this->M_data->find('pembimbing', $where, '', '', '', '', 'skripsi', 'skripsi.id_skripsi = pembimbing.id_skripsi_pmb', 'mahasiswa', 'mahasiswa.nim = pembimbing.nim_mhs_pmb');
		
		if ($cek['pembimbing']->num_rows() > 0) {

			foreach ($cek['pembimbing']->result() as $c) {

				$data['pemberitahuan'] = 'Proposal '.$c->judul_skripsi.' Telah Di ACC';
				$data['catatan'] = 'Proposal Telah Di ACC Oleh : <br>'.$this->session->userdata('nama_dosen').'Sebagai '.$c->level;
				$data['penerima'] = $c->nim;
				$data['pengirim'] = $this->session->userdata('nama_dosen');
				$data['tanggal'] = date('Y-m-d');
				$data['status'] = '<span class="text-right badge badge-info"> <i class="fas fa-info"></i> Proposal </span>';

				$ACC = array('status_proposal' => 'Disetujui');
				$this->M_data->update('id_pmb', $id_pmb, 'pembimbing', $ACC);
				$this->M_data->save($data, 'pemberitahuan');
			}
		}
	}
	function acc_skripsi($id_pmb)
	{
		$where = array('id_pmb' => $id_pmb,);
		
		$cek['pembimbing'] = $this->M_data->find('pembimbing', $where, '', '', '', '', 'skripsi', 'skripsi.id_skripsi = pembimbing.id_skripsi_pmb', 'mahasiswa', 'mahasiswa.nim = pembimbing.nim_mhs_pmb');
		
		if ($cek['pembimbing']->num_rows() > 0) {

			foreach ($cek['pembimbing']->result() as $c) {

				$data['pemberitahuan'] = 'Skripsi '.$c->judul_skripsi.' Telah Di ACC';
				$data['catatan'] = 'Skripsi Telah Di ACC Oleh : <br>'.$this->session->userdata('nama_dosen').'<br> Sebagai '.$c->level;
				$data['penerima'] = $c->nim;
				$data['pengirim'] = $this->session->userdata('nama_dosen');
				$data['tanggal'] = date('Y-m-d');
				$data['status'] = '<span class="text-right badge badge-info"> <i class="fas fa-info"></i> Skripsi </span>';

				$ACC = array('status_skripsi' => 'Disetujui');

				$this->M_data->update('id_pmb', $id_pmb, 'pembimbing', $ACC);
				$this->M_data->save($data, 'pemberitahuan');
			}
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
}