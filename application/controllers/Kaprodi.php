<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kaprodi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != "Kaprodi") {
			redirect(base_url("Home"));
		}
    $this->load->library('Ajax_pagination');
    $this->perPage = 3;
  }

  public function index()
  {
    $this->load->view('template/navbar');
  }

  public function beranda()
  {
    $this->load->view('kaprodi/home');
  }

  function pmb(){

    $pmb1 = $this->input->post('pmb1');
    $where = array('id_konsentrasi_dsn' => $this->session->userdata('id'));
    $data = $this->M_data->find('dosen', $where, "nik <>",  $pmb1);
    $lists = "<option value=''>Pilih</option>";

    foreach($data->result() as $u){
     $lists .= "<option value='".$u->nik."'>".$u->nama_dosen."</option>"; 
   }

   $callback = array('list'=> $lists); 
   echo json_encode($callback);
 }

 function update_password()
 {
  $id = $this->session->userdata('nik');
  $where = array('id' => $id);
  $pass_lama = $this->input->post('pass_lama');

  $data['pass_jurusan'] = md5($this->input->post('pass_baru'));

  $cek = $this->M_data->find('dosen', $where);

  foreach ($cek->result() as $c) {

   $pass = $c->password;

   if (md5($pass_lama) === $pass) {
    $this->M_data->update('id', $id, 'jurusan', $data);
    echo 1;
  } else {
    echo 0;
  }
}
 }

function mahasiswa()
{
  $data = array();

  $total = count($this->M_data->find('skripsi','', 'id_konsentrasi_mhs', $this->session->userdata('id_konsentrasi'), '', '', 'mahasiswa', 'mahasiswa.nim = skripsi.nim_mhs_skripsi'));

  $config['target'] = '.tabel_mahasiswa';
  $config['base_url'] = base_url().'Kaprodi/page_mhs';
  $config['total_rows'] = $total;
  $config['per_page'] = $this->perPage;
  $config['link_func']   = 'searchmhs';
  
  $this->ajax_pagination->initialize($config);
  
  $data['skripsi'] = $this->M_data->find('skripsi', '', 'id_konsentrasi_mhs', $this->session->userdata('id'), 'id_skripsi', 'DESC', 'mahasiswa', 'mahasiswa.nim = skripsi.nim_mhs_skripsi', '', '', '', '', array('limit' => $this->perPage));
  
  $this->load->view('kaprodi/mahasiswa', $data);
}

function page_mhs()
{
  $page = $this->input->post('page');
  if (!$page) {
    $offset = 0;
  } else {
    $offset = $page;
  }

  $keywords = $this->input->post('keywords');
  $cari = $this->input->post('cari_mhs');

  if(!empty($keywords)){
    $conditions['search']['keywords'] = $keywords;
  }
  if(!empty($sortBy)){
    $conditions['search']['sortBy'] = $sortBy;
  }

  $total = count($this->M_data->find('skripsi','', 'id_konsentrasi_mhs', $this->session->userdata('id_konsentrasi'), '', '', 'mahasiswa', 'mahasiswa.nim = skripsi.nim_mhs_skripsi'));

  $config['target'] = '.tabel_mahasiswa';
  $config['base_url'] = base_url().'Kaprodi/page_mhs';
  $config['total_rows'] = $total;
  $config['per_page'] = $this->perPage;
  $config['link_func']   = 'searchmhs';

  $this->ajax_pagination->initialize($config);

  $conditions['start'] = $offset;
  $conditions['limit'] = $this->perPage;

  $data['skripsi'] = $this->M_data->find('skripsi','', 'id_konsentrasi_mhs', $this->session->userdata('id_konsentrasi'), 'id_skripsi', 'DESC', 'mahasiswa', 'mahasiswa.nim = skripsi.nim_mhs_skripsi', '', '', '', '', $conditions, $cari);
  
  $this->load->view('kaprodi/page_mhs', $data);  

}

function nilai($id_skripsi)
{
  $data = $this->input->post('nilai');
  $where = array('nilai' => $data);
  $this->M_data->update('id_skripsi', $id_skripsi, 'skripsi', $where);
}

function daftar()
{
  $id = $this->session->userdata('id');
  $where = array('id_konsentrasi' => $id);
  $data['pendaftaran'] = $this->M_data->find('pendaftaran', $where);
  $this->load->view('kaprodi/daftar', $data);
}

function aksi_daftar($nim)
{
		 $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/images/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);



        $where = array('nim' => $nim);
        $Get['pendaftaran'] = $this->M_data->find('pendaftaran', '' ,'nim', $nim);
        foreach ($Get['pendaftaran'] as $p) {
        	
		    $image_name=$p->nim.'.png';            //buat name dari qr code sesuai dengan nim

       		$params['data'] = base_url('Cetak/kartu/'.$p->nim); //data yang akan di jadikan QR CODE
        	$params['level'] = 'H'; //H=High
        	$params['size'] = 10;
        	$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
      		$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

      		$data['nim'] = $p->nim;
      		$data['nama_mhs'] = $p->nama;
      		$data['password_mhs'] = md5($p->password);
      		$data['id_jurusan_mhs'] = $p->id_jurusan;
      		$data['id_konsentrasi_mhs'] = $p->id_konsentrasi;
      		$data['nohp_mhs'] = $p->nohp;
      		$data['email_mhs'] = $p->email;
      		$data['foto_mhs'] = $p->foto;
      		$data['status_mhs'] = 'Proses Skripsi';
      		$data['QR_Code'] = $image_name;

      		$this->M_data->save($data, 'mahasiswa');
      		$this->M_data->delete($where, 'pendaftaran');
      	}
      }

      function pembimbing($id)
      {
      	$data['pembimbing'] = $this->M_data->find('pembimbing','', 'id_skripsi', $id, '', '', 'mahasiswa' ,'mahasiswa.nim = pembimbing.nim_mhs_pmb', 'skripsi', 'skripsi.id_skripsi = pembimbing.id_skripsi_pmb', 'dosen', 'dosen.nik = pembimbing.nik_dsn_pmb');
      	$this->load->view('kaprodi/dosen', $data);
      }

      function form_kegiatan()
      {	
      	$data['mahasiswa'] = $this->M_data->find('mahasiswa', '', 'id_konsentrasi_mhs', $this->session->userdata('id'));
      	$this->load->view('kaprodi/form_kegiatan', $data);
      }

      public function profilmahasiswa($id_pmb)
      {
      	$this->load->view('template/navbar');
      	$where = array('id_pmb' => $id_pmb,);
      	$data['pembimbing'] = $this->M_data->find('pembimbing','', 'id_skripsi', $id, '', '', 'mahasiswa' ,'mahasiswa.nim = pembimbing.nim_mhs_pmb', 'skripsi', 'skripsi.id_skripsi = pembimbing.id_skripsi_pmb', 'dosen', 'dosen.nik = pembimbing.nik_dsn_pmb');
      	foreach ($data['pembimbing']->result() as $c) {

      		$nim = $c->nim_mhs_ide; 

      		$data['konsultasi'] = $this->M_data->find('konsultasi', 'nim_mhs_ks', $nim);

      		$this->load->view('kaprodi/profilmahasiswa', $data);

      	}
      }

      public function form_dosen()
      {
      	$data['dosen'] = $this->M_data->find('dosen');
      	$this->load->view('kaprodi/form_dosen', $data);
      }

      public function profildosen($nik)
      {
      	$where = array('nik' => $nik);
      	$data['pembimbing'] = $this->M_data->find('pembimbing','', 'nik', $nik, '', '', 'mahasiswa' ,'mahasiswa.nim = pembimbing.nim_mhs_pmb', 'skripsi', 'skripsi.id_skripsi = pembimbing.id_skripsi_pmb', 'dosen', 'dosen.nik = pembimbing.nik_dsn_pmb');
      	$data['dosen'] = $this->M_data->find('dosen', $where);
      	$this->load->view('template/navbar')->view('kaprodi/profildosen', $data);
      }

      public function ide_skripsi()
      {

      	$id = $this->session->userdata('id');
        $where = array('id_konsentrasi_mhs' => $id);
        $data['dosen'] = $this->M_data->find('dosen', '', 'id_konsentrasi_dsn', $id);
        $data['ide_skripsi'] = $this->M_data->find('ide_skripsi', $where, '', '', 'id_ide', 'DESC', 'mahasiswa', 'mahasiswa.nim = ide_skripsi.nim_mhs_ide');
        $this->load->view('kaprodi/ide_skripsi', $data);
      }

      public function aksi_skripsi($id_skripsi)
      {

      	$where = array('id_ide' => $id_skripsi);

      	$cek = $this->M_data->find('ide_skripsi', $where, '', '', '', '', 'mahasiswa', 'mahasiswa.nim = ide_skripsi.nim_mhs_ide');

      	if ($cek->num_rows() > 0) {

      		foreach ($cek->result() as $s) {

      			$pmb1 = $this->input->post('pmb1');
      			$pmb2 = $this->input->post('pmb2');

      			$head = $s->judul;
      			$catatan = $this->input->post('catatan');
      			$catatan_dosen = 'Anda Di Tetapkan Sebagai Dosen Pembimbing '.$s->nama_mhs.' Silahkan Lihat Di Data Skripsi';
      			$deskripsi = $s->deskripsi;
      			$penerima = $s->nim;
      			$tanggal = date('Y-m-d');
      			$pengirim = $this->session->userdata('nik');;
      			$status = '<span class="text-right badge badge-success"> <i class="fas fa-thumbs-up"></i> Diterima </span>';

      			$dosen1 = array('nik_dsn_pmb' => $pmb1, 'id_skripsi_pmb' => $s->id_ide, 'nim_mhs_pmb' => $penerima, 'status_proposal' => 'Belum Disetujui', 'status_skripsi' => 'Belum Disetujui' , 'level' => 'Pembimbing 1');
      			$dosen2 = array('nik_dsn_pmb' => $pmb2, 'status_proposal' => 'Belum Disetujui', 'status_skripsi' => 'Belum Disetujui', 'id_skripsi_pmb' => $s->id_ide, 'nim_mhs_pmb' => $penerima, 'level' => 'Pembimbing 2');
      			$sh = array('id_skripsi' => $s->id_ide ,'judul_skripsi' => $head, 'deskripsi' => $deskripsi, 'nim_mhs_skripsi' => $penerima, 'tanggal' => $tanggal);

      			$pemberitahuan = array('pemberitahuan' => $head, 'catatan' => $catatan, 'penerima' => $penerima, 'tanggal' => $tanggal, 'pengirim' => $pengirim, 'penerima' => $penerima, 'status' => $status);

      			$pemberitahuan2 = array('pemberitahuan' => $head, 'catatan' => $catatan_dosen, 'penerima' => $penerima, 'tanggal' => $tanggal, 'pengirim' => $pengirim, 'penerima' => $pmb1, 'status' => $status);


      			$pemberitahuan3 = array('pemberitahuan' => $head, 'catatan' => $catatan_dosen, 'penerima' => $penerima, 'tanggal' => $tanggal, 'pengirim' => $pengirim, 'penerima' => $pmb2, 'status' => $status);

      			$id = array('id_skripsi_mhs' => $id_skripsi);

      			$this->M_data->update('nim', $s->nim, 'mahasiswa', $id);
      			$this->M_data->save($sh, 'skripsi');
      			$this->M_data->save($dosen1, 'pembimbing');
      			$this->M_data->save($dosen2, 'pembimbing');
      			$this->M_data->save($pemberitahuan, 'pemberitahuan');
      			$this->M_data->save($pemberitahuan2, 'pemberitahuan');
      			$this->M_data->save($pemberitahuan3, 'pemberitahuan');
      			$this->M_data->delete($where, 'ide_skripsi');
      		}


      	}
      	redirect('kaprodi');
      }

      function rejected($id_skripsi)
      {
      	$where = array('id_ide' => $id_skripsi);

      	$cek = $this->M_data->find('ide_skripsi', $where, '', '', '', '', 'mahasiswa', 'mahasiswa.nim = ide_skripsi.nim_mhs_ide');

      	if ($cek->num_rows() > 0) {

      		foreach ($cek->result() as $s) {

      			$head = $s->judul;
      			$catatan = $this->input->post('catatan');
      			$deskripsi = $s->deskripsi;
      			$penerima = $s->nim;
      			$tanggal = date('Y-m-d');
      			$pengirim = $this->session->userdata('nik');;
      			$status = '<span class="text-right badge badge-danger"> <i class="fas fa-thumbs-down"></i> Ditolak </span>';


      			$pemberitahuan = array('pemberitahuan' => $head, 'catatan' => $catatan, 'penerima' => $penerima, 'tanggal' => $tanggal, 'pengirim' => $pengirim, 'penerima' => $penerima, 'status' => $status);

      			$id = array('skripsi' => $id_skripsi);

      			$this->M_data->save($pemberitahuan, 'pemberitahuan');
      			$this->M_data->delete($where, 'ide_skripsi');
      		}
      	}
      }

      function aksi_kegiatan()
      {
      	$kegiatan = $this->input->post('kegiatan');
      	$jam = $this->input->post('jam');
      	$tempat = $this->input->post('tempat');
      	$penerima = $this->input->post('penerima');
      	$tanggal = $this->input->post('tanggal');

      	$data['pemberitahuan'] = 'Kegiatan '.$kegiatan.' Telah Ditetapkan';
      	$data['catatan'] = '<i class="fas fa-clock mr-auto"></i>  '.$jam.'<br> <i class="fas fa-map-marker mr-auto"></i>  '.$tempat.'<br> <i class="fas fa-calendar-alt"></i> '.longdate_indo($tanggal);
      	$data['pengirim'] = $this->session->userdata('nik');
      	$data['penerima'] = $penerima;
      	$data['tanggal'] = date('Y-m-d');
      	$data['status'] = '<span class="text-right badge badge-info"> <i class="fas fa-info"></i>'.$kegiatan.'</span>';

      	$this->M_data->save($data, 'pemberitahuan');
      }

      function delete_daftar($nim)
      {
      	$where = array('nim' => $nim);
      	$cek = $this->M_data->find('pendaftaran', $where);

      	foreach ($cek->result() as $c) {
      		unlink('./assets/images/'.$c->foto);
      		$this->M_data->delete($where, 'pendaftaran');
      	}
      }

    }
