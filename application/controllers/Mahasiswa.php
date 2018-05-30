<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	private $konsul = 'konsultasi';
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != "mahasiswa") {
			redirect(base_url("Home"));
		}
		
	}

	public function index()
	{
		$data['mahasiswa'] = $this->M_data->find('mahasiswa', '', 'nim', $this->session->userdata('nim'));
		$this->load->view('template/navbar')->view('mahasiswa/home',$data);
	}

	public function myprofil()
	{
		$data['mahasiswa'] = $this->M_data->find('mahasiswa', '', 'nim', $this->session->userdata('nim'));
		$this->load->view('mahasiswa/myprofil', $data);
	}

	function update_password()
	{
		$nim = $this->session->userdata('nim');
		$data = array('pwd_mhs' => md5($this->input->post('pass_baru')));
		$pass_lama = md5($this->input->post('pass_lama'));
		$where = array('nim' => $nim);

		$pass = $this->session->userdata('pwd_mhs');
		$cek = $this->M_data->find('mahasiswa', $where);

		foreach ($cek->result() as $c) {
			$pass = $c->pwd_mhs;

			if ($pass === $pass_lama ) {
				$this->M_data->update('nim', $nim, 'mahasiswa', $data);
				echo 1;
			} else {
				echo 0;
			}	

		}
	}

	public function pemberitahuan()
	{
		$where = array('penerima' => $this->session->userdata('nim'));
		$data['pemberitahuan'] = $this->M_data->find('pemberitahuan', $where, '', '', 'id', 'DESC', 'dosen','dosen.nik = pemberitahuan.pengirim');
		$this->load->view('mahasiswa/pemberitahuan', $data);
	}

	public function pengajuan()
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
		$this->load->view('mahasiswa/form_ide');
	}

	function ide_skripsi()
	{
		$where = array('nim_mhs_ide' => $this->session->userdata('nim'));
		$data['ide_skripsi'] = $this->M_data->find('ide_skripsi', $where, '', '', 'id_ide', 'DESC');

		$this->load->view('mahasiswa/ide_skripsi', $data);
	}

	function hapus($id)
	{
		$where = array('id' => $id);
		$this->M_data->delete($where, 'pemberitahuan');
	}

	function konsultasi()
	{
		$data['skripsi'] = $this->M_data->find('skripsi', '', 'nim_mhs_skripsi', $this->session->userdata('nim'), '', '', 'mahasiswa', 'mahasiswa.id_skripsi_mhs = skripsi.id_skripsi');
		$data['konsultasi'] = $this->M_data->find('konsultasi', '', 'nim_mhs_ks', $this->session->userdata('nim'));

		
		$mahasiswa = $this->M_data->find('mahasiswa', '', 'nim', $this->session->userdata('nim'));
		foreach ($mahasiswa as $m) {
			$data['pembimbing'] = $this->M_data->find('pembimbing','', 'id_skripsi', $m->id_skripsi_mhs, '', '', 'mahasiswa' ,'mahasiswa.nim = pembimbing.nim_mhs_pmb', 'skripsi', 'skripsi.id_skripsi = pembimbing.id_skripsi_pmb', 'dosen', 'dosen.nik = pembimbing.nik_dsn_pmb');
		}
		
		$this->load->view('mahasiswa/konsultasi', $data);
	}

	function update(){
		$id= $this->input->post("id");
		$value= $this->input->post("value");
		$modul= $this->input->post("modul");
		$data[$modul] = $value;
		$this->M_data->update('nim', $id, 'mahasiswa', $data);
		echo "{}";
	}

}