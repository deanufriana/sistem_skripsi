<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerGlobal extends CI_Controller {

	function index()
	{
		
	}

	function ubahPassword($id, $user)
	{
		switch ($user) {
			case 'admin': 
			$key = 'id_admin';
			break;
			case 'mahasiswa':
			$key = 'nim';
			break;
			default:
			$key = 'nik';
			break;
		}

		$where = array($key => $id);
		$pass_lama = md5($this->input->post('pass_lama'));

		$data['password'] = md5($this->input->post('pass_baru'));

		if (!(empty($this->input->post('username')))) {
			$data['username'] = $this->input->post('username');
		};

		$cek = $this->M_data->find($user, $where);

		foreach ($cek->result() as $c) {

			$pass = $c->password;

			if ($pass_lama === $pass) {
				$this->M_data->update($key, $id, $user, $data);
				echo 1;
			} else {
				echo 0;
			}
		}
	}

	function downloadFile($filename)
	{
		$this->load->helper('download');

		force_download('assets/proposal/'.$filename, NULL);
	}

	function deleteNotifikasi($id)
	{
		$where = array('id' => $id);
		$this->M_data->delete($where, 'pemberitahuan');
	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */