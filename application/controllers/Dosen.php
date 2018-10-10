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
		$status = $this->session->userdata('Status');
		if (!(($status == "Dosen") OR ($status == "Kaprodi"))) {
			redirect(base_url("Home"));
		}
		$this->load->library('Ajax_pagination');
		$this->perPage = 2;
	}

	function index()
	{
		
		$id = array('ID' => $_SESSION['ID']);
		
		$Penerima = array('IDPenerima' => $_SESSION['ID']);
		
		$data['Notifikasi'] = $this->M_data->find('Notifikasi', $Penerima, '', '', '', '', 'users', 'users.ID = Notifikasi.IDPengirim');
		
		$kaprodi = $this->M_data->find('users', $id);

		$result = $kaprodi->row();
		$where = array('IDKonsentrasiUser' => $result->IDKonsentrasiUser);

		$data['ideskripsi'] = $this->M_data->find('ideskripsi', $where, '', '', 'IDIde', 'DESC', 'users', 'users.ID = ideskripsi.IDIdeMahasiswa');

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

		if(!empty($keywords)){
			$conditions['search']['keywords'] = $keywords;
		}
		if(!empty($sortBy)){
			$conditions['search']['sortBy'] = $sortBy;
		}

		$conditions['start'] = $offset;
		$conditions['limit'] = $this->perPage;

		$users = $this->M_data->find('users', $where); 

		foreach ($users->result() as $u) {
			$IDKonsentrasi = $u->IDKonsentrasiUser;
			$Status = $u->Status;

			$whereID = array(
				'IDKonsentrasiUser' => $u->IDKonsentrasiUser
			);
		}	


		$data['users'] = $this->M_data->find('skripsi', $whereID, '', '', '', '', 'users', 'users.ID = skripsi.IDMahasiswaSkripsi', '', '', '','', $conditions, $search);

		$total = $this->M_data->find('skripsi', $whereID, '', '', '', '', 'users', 'users.ID = skripsi.IDMahasiswaSkripsi');

		$totalData = $total->num_rows();

		$config['target'] = '#tabel_mhs_kaprodi';
		$config['base_url'] = base_url().'Kaprodi/tabelSkripsi';
		$config['total_rows'] = $totalData;
		$config['per_page'] = $this->perPage;
		$config['link_func']   = 'searchmhs';

		$this->ajax_pagination->initialize($config);


		$data['pembimbing'] = $this->M_data->find('pembimbing', '', '', '', '', '', 'users', 'users.ID = pembimbing.IDDosenPmb');

		$this->load->view('dosen/tabelSkripsi', $data, false);  

	}

	function detailDosen($nik)
	{
		$where = array('ID' => $nik);
		$wherep = array('IDDosenPmb' => $nik);
		$data['pembimbing'] = $this->M_data->find('pembimbing',$wherep, '', '', '', '', 'users' ,'users.ID = pembimbing.IDDosenPmb', 'skripsi', 'skripsi.IDSkripsi = pembimbing.IDSkripsiPmb');
		$data['dosen'] = $this->M_data->find('users', $where);
		$this->load->view('template/navbar')->view('kaprodi/detailDosen', $data);
	}

	function detailMahasiswa($ID) 
	{
		$where = array(
			'IDMahasiswaSkripsi' => $ID,
		);

		$data['skripsi'] = $this->M_data->find('skripsi', $where, '', '', '', '', 'users', 'users.ID = skripsi.IDMahasiswaSkripsi');

		foreach ($data['skripsi']->result() as $s) {

			$wherepmb = array(
				'IDSkripsiPmb' => $s->IDSkripsi,
				'IDDosenPmb' => $_SESSION['ID'],
			);

			$data['pembimbing'] = $this->M_data->find('pembimbing', $wherepmb);

			foreach ($data['pembimbing']->result() as $p) {
				$whereProp = array('StatusProposal' => $p->StatusProposal);

				$data['proposal'] =  $this->M_data->find('pembimbing', $whereProp);

			}

		}
		$data['konsultasi'] = $this->M_data->find('kartubimbingan', '' , 'IDKartuMahasiswa', $ID, '', '', 'users', 'users.ID = kartubimbingan.IDDosenPembimbing');

		$this->load->view('template/navbar');
		$this->load->view('dosen/detailMahasiswa', $data); 
	}

	function accUsers($ID, $users)
	{
		$where = array(
			'IDSkripsiPmb' => $ID,
			'IDDosenPmb' => $_SESSION['ID']
		);

		$cek['Pembimbing'] = $this->M_data->find('skripsi', $where, '', '', '', '', 'pembimbing', 'pembimbing.IDSkripsiPmb = skripsi.IDSkripsi');	

		foreach ($cek['Pembimbing']->result() as $c) {

			$data['Notifikasi'] = $users.''.$c->JudulSkripsi.' Telah Di ACC';
			$data['Catatan'] = $users.' Telah Di ACC Oleh : <br>'.$this->session->userdata('Nama').' Sebagai Pembimbing '.$c->StatusPembimbing;
			$data['IDPenerima'] = $c->IDMahasiswaSkripsi;
			$data['IDPengirim'] = $_SESSION['ID'];
			$data['TanggalNotifikasi'] = date('Y-m-d');
			$data['StatusNotifikasi'] = $users;

			$accept['Status'.$users] = 1;

			$this->M_data->update('IDPembimbing', $c->IDPembimbing, 'pembimbing', $accept);
			$this->M_data->save($data, 'Notifikasi'); 

		}
	}

	function catatan($ID)
	{
		$data['TanggalBimbingan'] = date('Y-m-d');
		$data['Catatan'] = $this->input->post('note');
		$data['IDDosenPembimbing'] = $_SESSION['ID'];
		$data['IDKartuMahasiswa'] = $ID;
		$this->M_data->save($data, 'kartubimbingan');
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