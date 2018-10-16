<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerGlobal extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$status = $this->session->userdata('Status');
		if (!(($status == "Mahasiswa") OR ($status == "Skripsi") OR ($status == "Dosen"))) {
			redirect(base_url("Home"));
		}
	}

	function myProfil()
	{
		$where = array('ID' => $this->session->userdata('ID'));
		$data['users'] = $this->M_data->find('users', $where, '', '', 'jurusan', 'jurusan.IDJurusan = users.IDJurusanUser', 'konsentrasi', 'konsentrasi.IDKonsentrasi = users.IDKonsentrasiUser');
		$this->load->view('template/myProfil', $data);
	}

	function notifikasi()
	{
		$where = array('IDPenerima' => $this->session->userdata('ID'));
		$data['Notifikasi'] = $this->M_data->find('Notifikasi', $where,  'IDNotifikasi', 'DESC', 'users', 'users.ID = Notifikasi.IDPengirim');
		$this->load->view('template/notifikasi', $data);
	}

	function ubahPassword($id, $user)
	{
		switch ($user) {
			case 'admin': 
			$key = 'id_admin';
			default:
			$key = 'ID';
			break;
		}

		$where = array($key => $id);
		$pass_lama = md5($this->input->post('pass_lama'));

		$data['Password'] = md5($this->input->post('pass_baru'));

		if (!(empty($this->input->post('username')))) {
			$data['username'] = $this->input->post('username');
		};

		$cek = $this->M_data->find($user, $where);

		$result = $cek->row();

		if ($pass_lama === $result->Password) {
			$this->M_data->update($key, $id, $user, $data);
			echo 1;
		} else {
			echo 0;
		}
	}
	
	function downloadFile($filename)
	{
		$this->load->helper('download');

		force_download('assets/proposal/'.$filename, NULL);
	}

	function deleteNotifikasi($id)
	{
		$where = array('IDNotifikasi' => $id);
		$this->M_data->delete($where, 'Notifikasi');
	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */