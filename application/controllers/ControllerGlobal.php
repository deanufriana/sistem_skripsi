<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerGlobal extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$status = $this->session->userdata('Status');
		if (!(($status == "Mahasiswa") OR ($status == "Skripsi") OR ($status == "Dosen") OR ($status == "Admin"))) {
			redirect(base_url("Home"));
		}
	}

	function myProfil()
	{
		$where = array('ID' => $this->session->userdata('ID'));
		$data['users'] = $this->M_data->find('users', $where, '', '', 'jurusan', 'jurusan.IDJurusan = users.IDJurusanUser', 'konsentrasi', 'konsentrasi.IDKonsentrasi = users.IDKonsentrasiUser');
		$this->load->view('template/myProfil', $data);
        $this->load->view('template/jquery/formSubmit');
	}

	function notifikasi()
	{
		$where = array('IDPenerima' => $this->session->userdata('ID'));
		$data['Notifikasi'] = $this->M_data->find('notifikasi', $where,  'IDNotifikasi', 'DESC', 'users', 'users.ID = notifikasi.IDPengirim');
		$this->load->view('template/notifikasi', $data);
	}

	function ubahPassword($id, $user)
	{
		if ($user === 'admin') {
			$key = 'id_admin';
		} else {
			$key = 'ID';
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
	
	function downloadFile($status, $filename)
	{
		$this->load->helper('download');
		force_download('assets/'.$status.'/'.$filename, NULL);
	}

	function uploadFoto()
	{
		if (!is_dir('./assets/images/users')) {
			mkdir('./assets/images');
            mkdir('./assets/images/users');			
		}
		
		$id= $_SESSION['ID'];
		
		$config['upload_path'] = './assets/images/users';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['overwrite'] = true;
		$config['file_name']	= $id;
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('upload')){
			
			$error = $this->upload->display_errors();

			$notif = array(
				'head' => "Maaf Terjadi Kesalahan",
				'isi' => $error,
				'sukses' => 0
			);

		} else {
	

			$foto = $this->upload->data();

			$query = $this->db->query("SELECT Foto FROM users WHERE ID=$id");

			$data['Foto'] = $foto['file_name'];

			$this->M_data->update('ID', $id, 'users', $data);

			$notif = array(
				'head' => "Upload Berhasil",
				'isi' => 'Berhasil',
				'sukses' => 1
			);
		}

		echo json_encode($notif);
		
	}

	function deleteNotifikasi($id)
	{
		$where = array('IDNotifikasi' => $id);
		$this->M_data->delete($where, 'notifikasi');
	}

	function update(){
		$id= $_SESSION['ID'];
		$value= $this->input->post("value");
		$modul= $this->input->post("modul");
		$data[$modul] = $value;

		$this->M_data->update('ID', $id, 'users', $data);
		echo "{}";
	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */