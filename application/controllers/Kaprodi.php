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

	function __construct()
	{
		parent::__construct();
    $where = array('IDDosen' => $_SESSION['ID']);
    $dosen = $this->M_data->find('konsentrasi', $where);
		if ($dosen->num_rows() === 0) {
      redirect(base_url("Home"));
    }

    $this->load->library('Ajax_pagination');
    $this->perPage = 3;
  }

  function index()
  {
    $id = $this->session->userdata('ID');
    
    $where = array('IDPenerima' => $id);
    $data['Notifikasi'] = $this->M_data->find('Notifikasi', $where, '', '', '', '', 'users', 'users.ID = Notifikasi.IDPengirim');
    
    $whereID = array('IDKonsentrasiUser' => $id);

    $data['ideskripsi'] = $this->M_data->find('ideskripsi', $whereID, '', '', 'IDIde', 'DESC', 'users', 'users.ID = ideskripsi.IDIdeMahasiswa');

    $this->load->view('template/navbar');
    $this->load->view('dosen/home', $data);
  }


  function filterPembimbing(){

    $pmb1 = $this->input->post('pmb1');
    $id = array('ID' => $_SESSION['ID']);
    $kaprodi = $this->M_data->find('users', $id);

    $result = $kaprodi->row();

    $where = array(
      'IDKonsentrasiUser' => $result->IDKonsentrasiUser,
      'Status' => 'Dosen',
      'ID <>' => $pmb1,
    );

    $data = $this->M_data->find('users', $where);
    
    $lists = "<option value=''>Pilih</option>";

    foreach($data->result() as $u){
     $lists .= "<option value='".$u->ID."'>".$u->Nama."</option>"; 
   }

   $callback = array('list'=> $lists); 
   echo json_encode($callback);
 }

 function nilai()
 {

  $id= $this->input->post("id");
  $value= $this->input->post("value");
  $modul= $this->input->post("modul");

  $users = $this->M_data->find('users', '', 'IDSkripsi', $id);
  foreach ($users as $m) {
    $ID = $m->ID;
    $status = array('status' => 'Alumni');
    $this->M_data->update('ID', $ID, 'users', $status);
  }
  $data[$modul] = $value;
  $this->M_data->update('IDSkripsi', $id, 'skripsi', $data);
  echo "{}";
}

function formKegiatan()
{	
  $data = array('ID' => $_SESSION['ID']);
  $users = $this->M_data->find('users', $data);

  $result = $users->row();

  $where = array(
    'IDKonsentrasiUser' => $result->IDKonsentrasiUser,
    'Status' => 'Skripsi'
  );

  $data['users'] = $this->M_data->find('users', $where);
  $this->load->view('kaprodi/formKegiatan', $data);
}

function ideSkripsi()
{

 $id = array('ID' => $_SESSION['ID']);
 $kaprodi = $this->M_data->find('users', $id);

 $result = $kaprodi->row();
 $where = array('IDKonsentrasiUser' => $result->IDKonsentrasiUser);
 $dosen = array('IDKonsentrasiUser' => $result->IDKonsentrasiUser,  'Status' => 'Dosen');

 $data['dosen'] = $this->M_data->find(
  'users', $dosen
);

 $data['ideskripsi'] = $this->M_data->find('ideskripsi', $where, '', '', 'IDIde', 'DESC', 'users', 'users.ID = ideskripsi.IDIdeMahasiswa');

 $this->load->view('kaprodi/ideSkripsi', $data);
}

function acceptSkripsi($idSkripsi, $sta)
{
  $note = $this->input->post('catatan');
  $where['IDIde'] = $idSkripsi;

  $pengirim = $_SESSION['ID'];
  $tanggal = date('Y-m-d');

  $ideSkripsi = $this->M_data->find('ideskripsi', $where, '', '', '', '', 'users', 'users.ID = ideskripsi.IDIdeMahasiswa');

  foreach ($ideSkripsi->result() as $d) {
    $IDIde = $d->IDIde;
    $judul = $d->JudulIde;
    $deskripsi = $d->DeskripsiIde;
    $ID = $d->ID;
    $nama = $d->Nama;
  }

  if ($sta) {

    $this->load->library('ciqrcode');

    $config['cacheable']    = true; 
    $config['cachedir']     = './assets/'; 
    $config['errorlog']     = './assets/'; 
    $config['imagedir']     = './assets/images/QRCode/'; 
    $config['quality']      = true; 
    $config['size']         = '1024'; 
    $config['black']        = array(224,255,255); 
    $config['white']        = array(70,130,180); 
    $this->ciqrcode->initialize($config);

    $params['data'] = base_url('Cetak/kartu/'.$ID);
    $params['level'] = 'H';
    $params['size'] = 10;
    $params['savename'] = FCPATH.$config['imagedir'].$ID.'.png';

    $this->ciqrcode->generate($params);

    
    $sh = array('IDSkripsi' => $IDIde ,'JudulSkripsi' => $judul, 'QRCode' => $ID.'.png', 'Deskripsi' => $deskripsi, 'IDMahasiswaSkripsi' => $ID, 'Tanggal' => $tanggal);
    $this->M_data->save($sh, 'skripsi');


    for ($i=1; $i < 3; $i++) { 

      $pmb = $this->input->post('pmb'.$i);

      // Memasukan Dosen Pembimbing Ke Database
      $dosen = array('IDDosenPmb' => $pmb, 'IDSkripsiPmb' => $IDIde, 'StatusProposal' => 0, 'StatusSkripsi' => 0, 'StatusPembimbing' => $i);
      $this->M_data->save($dosen, 'pembimbing');
      
      // Mengirim Pemberitahuan Ke Dosen Pembimbing
      $Catatan = 'Anda Di Tetapkan Sebagai Dosen Pembimbing <br>'.$nama.'<br> Silahkan Lihat Di Data Skripsi';

      $NotifDosen = array('Notifikasi' => $judul, 'Catatan' => $Catatan, 'TanggalNotifikasi' => $tanggal, 'IDPengirim' => $pengirim, 'IDPenerima' => $pmb, 'StatusNotifikasi' => 'Informasi');  
      $this->M_data->save($NotifDosen, 'notifikasi');

    }
    
    $whereIde = array('IDIdeMahasiswa' => $ID);

    $this->M_data->delete($whereIde, 'ideskripsi');

    $hasil = 'Diterima';

  } else {

    $hasil = 'Ditolak';

    $whereIde = array('IDIde' => $IDIde);

    $this->M_data->delete($whereIde, 'ideskripsi');
  }

  $NotifMhs = array('Notifikasi' => $judul, 'Catatan' => $note, 'TanggalNotifikasi' => $tanggal, 'IDPengirim' => $pengirim, 'IDPenerima' => $ID, 'StatusNotifikasi' => $hasil);
  $this->M_data->save($NotifMhs, 'notifikasi');

}

function aksiKegiatan()
{
  $kegiatan = $this->input->post('kegiatan');
  $jam = $this->input->post('jam');
  $tempat = $this->input->post('tempat');
  $penerima = $this->input->post('penerima');
  $tanggal = $this->input->post('tanggal');

  $data['Notifikasi'] = 'Kegiatan '.$kegiatan.' Telah Ditetapkan';
  $data['Catatan'] = '<i class="fas fa-clock mr-auto"></i>  '.$jam.'<br> <i class="fas fa-map-marker mr-auto"></i>  '.$tempat.'<br> <i class="fas fa-calendar-alt"></i> '.longdate_indo($tanggal);
  $data['IDPengirim'] = $_SESSION['ID'];
  $data['IDPenerima'] = $penerima;
  $data['TanggalNotifikasi'] = date('Y-m-d');
  $data['StatusNotifikasi'] = $kegiatan;

  $simpan = array(
    'IDUsers' => $penerima,
    'Kegiatan' => $kegiatan,
    'Tempat' => $tempat,
    'JamKegiatan' => $jam,
    'TanggalKegiatan' => $tanggal,
    'Finish' => 0,
  );

  $this->M_data->save($simpan, 'Kegiatan');
  $this->M_data->save($data, 'Notifikasi');

}

}