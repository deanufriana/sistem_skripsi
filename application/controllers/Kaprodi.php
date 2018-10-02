<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Sistem Skripsi Online Berbasis Web
 * @version    1
 * @author     Devi Adi Nufriana | https://facebook.com/mysilkyheart
 * @copyright  (c) 2018
 * @email      deanheart09@gmail.com
 *
 * PERINGATAN :
 * 1. TIDAK DIPERKENANKAN MEMPERJUALBELIKAN APLIKASI INI TANPA SEIZIN DARI PIHAK PENGEMBANG APLIKASI.
 * 2. TIDAK DIPERKENANKAN MENGHAPUS KODE SUMBER APLIKASI.
 * 3. TIDAK MENYERTAKAN LINK KOMERSIL (JASA LAYANAN HOSTING DAN DOMAIN) YANG MENGUNTUNGKAN SEPIHAK.
 */

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

  function index()
  {
    $this->load->view('template/navbar');
  }

  function beranda()
  {
    $id = $this->session->userdata('id');

    $where = array('id_konsentrasi_mhs' => $id);

    $data['ide_skripsi'] = $this->M_data->find('ide_skripsi', $where, '', '', 'id_ide', 'DESC', 'mahasiswa', 'mahasiswa.nim = ide_skripsi.nim_mhs_ide');

    $this->load->view('kaprodi/home', $data);
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

 function tabel_mhs_kaprodi()
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
  $config['base_url'] = base_url().'Kaprodi/tabel_mhs_kaprodi';
  $config['total_rows'] = $total;
  $config['per_page'] = $this->perPage;
  $config['link_func']   = 'searchmhs';

  $this->ajax_pagination->initialize($config);

  $conditions['start'] = $offset;
  $conditions['limit'] = $this->perPage;

  $data['skripsi'] = $this->M_data->find('skripsi','', 'id_konsentrasi_mhs', $this->session->userdata('id_konsentrasi'), 'id_skripsi', 'DESC', 'mahasiswa', 'mahasiswa.nim = skripsi.nim_mhs_skripsi', '', '', '', '', $conditions, $cari);
  
  $this->load->view('kaprodi/tabel_mhs_kaprodi', $data);  

}

function nilai()
{

  $id= $this->input->post("id");
  $value= $this->input->post("value");
  $modul= $this->input->post("modul");

  $mahasiswa = $this->M_data->find('mahasiswa', '', 'id_skripsi_mhs', $id);
  foreach ($mahasiswa as $m) {
    $nim = $m->nim;
    $status = array('status' => 'Alumni');
    $this->M_data->update('nim', $nim, 'mahasiswa', $status);
  }
  $data[$modul] = $value;
  $this->M_data->update('id_skripsi', $id, 'skripsi', $data);
  echo "{}";
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
 $this->load->library('ciqrcode');

 $config['cacheable']    = true;
 $config['cachedir']     = './assets/'; 
 $config['errorlog']     = './assets/'; 
 $config['imagedir']     = './assets/images/'; 
 $config['quality']      = true; 
 $config['size']         = '1024'; 
 $config['black']        = array(224,255,255); 
 $config['white']        = array(70,130,180); 
 $this->ciqrcode->initialize($config);



 $where = array('nim' => $nim);
 $Get['pendaftaran'] = $this->M_data->find('pendaftaran', '' ,'nim', $nim);
 foreach ($Get['pendaftaran'] as $p) {

  $image_name=$p->nim.'.png';            

  $params['data'] = base_url('Cetak/kartu/'.$p->nim); 
  $params['level'] = 'H'; 
  $params['size'] = 10;
  $params['savename'] = FCPATH.$config['imagedir'].$image_name; 
  $this->ciqrcode->generate($params);

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

function profil_mhs($nim)
{
 $this->load->view('template/navbar');
 $where = array('nim_mhs_pmb' => $nim,);
 $data['pembimbing'] = $this->M_data->find('pembimbing',$where, '', '', '', '', 'mahasiswa' ,'mahasiswa.nim = pembimbing.nim_mhs_pmb', 'skripsi', 'skripsi.id_skripsi = pembimbing.id_skripsi_pmb', 'dosen', 'dosen.nik = pembimbing.nik_dsn_pmb');

 $data['mahasiswa'] = $this->M_data->find('mahasiswa','', 'nim', $nim, '', '', 'skripsi', 'skripsi.id_skripsi = mahasiswa.id_skripsi_mhs');

 $data['konsultasi'] = $this->M_data->find('konsultasi', '' , 'nim_mhs_ks', $nim);

 $this->load->view('dosen/mhs_profil', $data);


}

function form_dosen()
{
 $data['dosen'] = $this->M_data->find('dosen');
 $this->load->view('kaprodi/form_dosen', $data);
}

function profildosen($nik)
{
 $where = array('nik' => $nik);
 $data['pembimbing'] = $this->M_data->find('pembimbing','', 'nik', $nik, '', '', 'mahasiswa' ,'mahasiswa.nim = pembimbing.nim_mhs_pmb', 'skripsi', 'skripsi.id_skripsi = pembimbing.id_skripsi_pmb', 'dosen', 'dosen.nik = pembimbing.nik_dsn_pmb');
 $data['dosen'] = $this->M_data->find('dosen', $where);
 $this->load->view('template/navbar')->view('kaprodi/profildosen', $data);
}

function ide_skripsi()
{

 $id = $this->session->userdata('id');
 $where = array('id_konsentrasi_mhs' => $id);

 $data['dosen'] = $this->M_data->find('dosen', '', 'id_konsentrasi_dsn', $id);

 $data['ide_skripsi'] = $this->M_data->find('ide_skripsi', $where, '', '', 'id_ide', 'DESC', 'mahasiswa', 'mahasiswa.nim = ide_skripsi.nim_mhs_ide');

 $this->load->view('kaprodi/ide_skripsi', $data);
}

function acceptSkripsi($idSkripsi, $status)
{
  $catatan = $this->input->post('catatan');
  $where['id_ide'] = $idSkripsi;

  $idIde = '';
  $judul = '';
  $deskripsi = '';
  $penerima = '';

  $pengirim = $this->session->userdata('nik');
  $tanggal = date('Y-m-d');

  $ideSkripsi = $this->M_data->find('ide_skripsi', $where, '', '', '', '', 'mahasiswa', 'mahasiswa.nim = ide_skripsi.nim_mhs_ide');

  foreach ($ideSkripsi->result() as $i) {
    $idIde = $i->id_ide;
    $judul = $i->judul;
    $deskripsi = $i->deskripsi;
    $penerima = $i->nim_mhs_ide;
    $nama = $i->nama_mhs;
  }

  if ($status === 'diterima') {

    $pmb1 = $this->input->post('pmb1');
    $pmb2 = $this->input->post('pmb2');

    $catatan_dosen = 'Anda Di Tetapkan Sebagai Dosen Pembimbing <br>'.$nama.'<br> Silahkan Lihat Di Data Skripsi';

    $dosen1 = array('nik_dsn_pmb' => $pmb1, 'id_skripsi_pmb' => $idIde, 'nim_mhs_pmb' => $penerima, 'status_proposal' => 'Belum Disetujui', 'status_skripsi' => 'Belum Disetujui' , 'level' => 'Pembimbing 1');
    $dosen2 = array('nik_dsn_pmb' => $pmb2, 'status_proposal' => 'Belum Disetujui', 'status_skripsi' => 'Belum Disetujui', 'id_skripsi_pmb' => $idIde, 'nim_mhs_pmb' => $penerima, 'level' => 'Pembimbing 2');
    $sh = array('id_skripsi' => $idIde ,'judul_skripsi' => $judul, 'deskripsi' => $deskripsi, 'nim_mhs_skripsi' => $penerima, 'tanggal' => $tanggal);

    $pemberitahuan = array('pemberitahuan' => $judul, 'catatan' => $catatan, 'penerima' => $penerima, 'tanggal' => $tanggal, 'pengirim' => $pengirim, 'penerima' => $penerima, 'status' => $status);

    $pemberitahuan2 = array('pemberitahuan' => $judul, 'catatan' => $catatan_dosen, 'penerima' => $penerima, 'tanggal' => $tanggal, 'pengirim' => $pengirim, 'penerima' => $pmb1, 'status' => $status);

    $pemberitahuan3 = array('pemberitahuan' => $judul, 'catatan' => $catatan_dosen, 'penerima' => $penerima, 'tanggal' => $tanggal, 'pengirim' => $pengirim, 'penerima' => $pmb2, 'status' => $status);

    $id = array('id_skripsi_mhs' => $idSkripsi);

    $whereIde['nim_mhs_ide'] = $penerima;

    $this->M_data->update('nim', $penerima, 'mahasiswa', $id);
    $this->M_data->save($sh, 'skripsi');
    $this->M_data->save($dosen1, 'pembimbing');
    $this->M_data->save($dosen2, 'pembimbing');
    $this->M_data->save($pemberitahuan, 'pemberitahuan');
    $this->M_data->save($pemberitahuan2, 'pemberitahuan');
    $this->M_data->save($pemberitahuan3, 'pemberitahuan');           
    $this->M_data->delete($whereIde, 'ide_skripsi');

  } else {

   $pemberitahuan = array('pemberitahuan' => $judul, 'catatan' => $catatan, 'penerima' => $penerima, 'tanggal' => $tanggal, 'pengirim' => $pengirim, 'penerima' => $penerima, 'status' => $status);

   $this->M_data->save($pemberitahuan, 'pemberitahuan');
   $this->M_data->delete($where, 'ide_skripsi');
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

}