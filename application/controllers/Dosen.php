<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

class Dosen extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$status = $this->session->userdata('Status');
		if (!(($status == "Dosen") or ($status == "Kaprodi"))) {
			redirect(base_url("Home"));
		}
		$this->load->library('Ajax_pagination');
		$this->perPage = 2;
	}

	function index()
	{

		$id = array('ID' => $_SESSION['ID']);

		$Penerima = array('IDPenerima' => $_SESSION['ID']);

		$data['Notifikasi'] = $this->M_data->find('notifikasi', $Penerima, '', '', 'users', 'users.ID = notifikasi.IDPengirim');

		$data['users'] = $this->M_data->find('users', $id, '', '', 'jurusan', 'jurusan.IDJurusan = users.IDJurusanUser');

		$result = $data['users']->row();
		$where = array('IDKonsentrasiUser' => $result->IDKonsentrasiUser);

		$data['ideskripsi'] = $this->M_data->find('ideskripsi', $where, 'IDIde', 'DESC', 'users', 'users.ID = ideskripsi.IDIdeMahasiswa');

		$this->load->view('template/navbar');
		$this->load->view('dosen/home', $data);
	}

	function tabelSkripsi()
	{

		$ID = $_SESSION['ID'];

		$where = array('ID' => $ID);

		$page = $this->input->post('page');
		if (!$page) {
			$offset = 0;
		} else {
			$offset = $page;
		}

		$keywords = $this->input->post('keywords');
		$search = $this->input->post('search');

		if (!empty($keywords)) {
			$conditions['search']['keywords'] = $keywords;
		}
		if (!empty($sortBy)) {
			$conditions['search']['sortBy'] = $sortBy;
		}

		$conditions['start'] = $offset;
		$conditions['limit'] = $this->perPage;

		$users = $this->M_data->find('users', $where);

		foreach ($users->result() as $u) {
			$IDKonsentrasi = $u->IDKonsentrasiUser;
			$Status = $u->Status;

			$whereID = array(
				'IDKonsentrasiUser' => $u->IDKonsentrasiUser,
				'Nilai =' => '',
				'Status' => 'Skripsi'
			);
		}


		$data['users'] = $this->M_data->find('skripsi', $whereID, '', '', 'users', 'users.ID = skripsi.IDMahasiswaSkripsi', '', '', '', '', $conditions, $search);

		$total = $this->M_data->find('skripsi', $whereID, '', '', 'users', 'users.ID = skripsi.IDMahasiswaSkripsi');

		$totalData = $total != FALSE ? $total->num_rows() : 0;

		$config['target'] = '#tabelUser';
		$config['base_url'] = base_url() . 'Kaprodi/tabelSkripsi';
		$config['total_rows'] = $totalData;
		$config['per_page'] = $this->perPage;
		$config['link_func']   = 'searchmhs';

		$this->ajax_pagination->initialize($config);

		if ($data['users']) {
			foreach ($data['users']->result() as $d) {

				$finish = array(
					'IDSkripsiPmb' => $d->IDSkripsi,
					'StatusSkripsi' => 1
				);
			}
			$data['finish'] = $this->M_data->find('pembimbing', $finish, '', '', 'users', 'users.ID = pembimbing.IDDosenPmb');
		}

		$data['pembimbing'] = $this->M_data->find('pembimbing', '', '', '', 'users', 'users.ID = pembimbing.IDDosenPmb');
		$this->load->view('dosen/tabelSkripsi', $data, false);
	}

	function detailDosen($nik)
	{
		$where = array('ID' => $nik);
		$wherep = array('IDDosenPmb' => $nik);
		$data['pembimbing'] = $this->M_data->find('pembimbing', $wherep, '', '', 'users', 'users.ID = pembimbing.IDDosenPmb', 'skripsi', 'skripsi.IDSkripsi = pembimbing.IDSkripsiPmb');
		$data['dosen'] = $this->M_data->find('users', $where);
		$this->load->view('template/navbar')->view('kaprodi/detailDosen', $data);
	}

	function detailMahasiswa($ID)
	{
		$where = array(
			'IDMahasiswaSkripsi' => $ID
		);

		$data['skripsi'] = $this->M_data->find('skripsi', $where,  '', '', 'users', 'ID = IDMahasiswaSkripsi');
		$data['uploader'] = $this->M_data->find('skripsi', $where,  '', '', 'users', 'ID = Uploader');

		$wherePMB = array(
			'IDSkripsiPmb' => $data['skripsi']->row_array()['IDSkripsi'],
			'IDDosenPmb' => $_SESSION['ID']
		);

		// Mengambil data pembimbing yang sedang melihat skripsi
		$data['pembimbing'] = $this->M_data->find('pembimbing', $wherePMB);

		$whereProp = array(
			'IDSkripsiPmb' => $data['skripsi']->row_array()['IDSkripsi']
		);

		// Array Proposal Berfungsi Untuk Menghitung Proposal Skripsi Yang Di ACC
		$data['proposal'] =  $this->M_data->find('pembimbing', $whereProp);

		$isSkripsi = array(
			'StatusProposal' => 1,
			'IDSkripsiPmb' => $data['skripsi']->row_array()['IDSkripsi']
		);

		$data['isSkripsi'] = $this->M_data->find('pembimbing', $isSkripsi) ? $this->M_data->find('pembimbing', $isSkripsi)->num_rows() === 2 ? 'Skripsi' : 'Proposal' : 'Proposal';

		$whereIDCard = array('IDKartuMahasiswa' => $ID);
		$data['konsultasi'] = $this->M_data->find('kartubimbingan', $whereIDCard, '', '', 'users', 'users.ID = kartubimbingan.IDDosenPembimbing');

		$this->load->view('template/navbar');
		$this->load->view('dosen/detailMahasiswa', $data);
	}

	function accUsers($ID, $users)
	{
		$where = array(
			'IDSkripsiPmb' => $ID,
			'IDDosenPmb' => $_SESSION['ID']
		);

		$cek['Pembimbing'] = $this->M_data->find('skripsi', $where, '', '', 'pembimbing', 'pembimbing.IDSkripsiPmb = skripsi.IDSkripsi');

		foreach ($cek['Pembimbing']->result() as $c) {

			$data['Notifikasi'] = $users . ' ' . $c->JudulSkripsi . ' Telah Di ACC';
			$data['Catatan'] = $users . ' Telah Di ACC Oleh : <br>' . $this->session->userdata('Nama') . ' Sebagai Pembimbing ' . $c->StatusPembimbing;
			$data['IDPenerima'] = $c->IDMahasiswaSkripsi;
			$data['IDPengirim'] = $_SESSION['ID'];
			$data['TanggalNotifikasi'] = date('Y-m-d');
			$data['StatusNotifikasi'] = $users;

			$accept['Status' . $users] = 1;

			$this->M_data->update('IDPembimbing', $c->IDPembimbing, 'pembimbing', $accept);
			$this->M_data->save($data, 'notifikasi');
		}
	}

	function catatan($IDskripsi, $ID, $status)
	{

		$config['upload_path'] = './assets/' . $status . '/';
		$config['allowed_types'] = 'pdf';
		$config['overwrite'] = true;
		$config['max_size'] = 0;
		$config['file_name'] = $ID;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file' . $status)) {
			$error = array('error' => $this->upload->display_errors());
			echo json_encode($error);
	
		} else {

			$file = $this->upload->data();

			$dataSkripsi = array(
				'file' . $status => $file['file_name'],
				'Uploader' => $_SESSION['ID']
			);
			
			$data['TanggalBimbingan'] = date('Y-m-d');
			$data['Catatan'] = $this->input->post('note');
			$data['IDDosenPembimbing'] = $_SESSION['ID'];
			$data['IDKartuMahasiswa'] = $ID;
			$berhasil = array('hasil' =>  'Berhasil');

			$this->M_data->update('IDSkripsi', $IDskripsi, 'skripsi', $dataSkripsi);
			$this->M_data->save($data, 'kartubimbingan');
			echo json_encode($berhasil);
		}
	}
}
