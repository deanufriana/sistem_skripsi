<?php defined('BASEPATH') or exit('No direct script access allowed');

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

class Kaprodi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $where = array('IDDosen' => $_SESSION['ID']);
        $dosen = $this->M_data->find('konsentrasi', $where);
        if (!$dosen) {
            redirect(base_url("Home"));
        }

        $this->load->library('Ajax_pagination');
        $this->perPage = 5;
    }

    public function index()
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

    public function filterPembimbing()
    {

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

        foreach ($data->result() as $u) {
            $lists .= "<option value='" . $u->ID . "'>" . $u->Nama . "</option>";
        }

        $callback = array('list' => $lists);
        echo json_encode($callback);
    }

    public function nilai()
    {
        $id = $this->input->post("id");
        $value = $this->input->post("value");
        $modul = $this->input->post("modul");

        $where = array('IDSkripsi' => $id);

        $skripsi = $this->M_data->find('skripsi', $where);
        foreach ($skripsi->result() as $m) {
            $ID = $m->IDMahasiswaSkripsi;
            $status = array('status' => 'Alumni');
            $this->M_data->update('ID', $ID, 'users', $status);
        }
        $data[$modul] = $value;
        $this->M_data->update('IDSkripsi', $id, 'skripsi', $data);
        echo "{}";
    }

    public function formKegiatan()
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

    public function ideSkripsi()
    {

        $id = array('ID' => $_SESSION['ID']);
        $kaprodi = $this->M_data->find('users', $id);

        $result = $kaprodi->row();
        $where = array('IDKonsentrasiUser' => $result->IDKonsentrasiUser);
        $dosen = array('IDKonsentrasiUser' => $result->IDKonsentrasiUser, 'Status' => 'Dosen');

        $data['dosen'] = $this->M_data->find(
            'users', $dosen
        );

        $data['ideskripsi'] = $this->M_data->find('ideskripsi', $where, 'IDIde', 'DESC', 'users', 'users.ID = ideskripsi.IDIdeMahasiswa');

        $this->load->view('kaprodi/ideSkripsi', $data);
    }

    public function acceptSkripsi($idSkripsi, $sta)
    {
        $note = $this->input->post('catatan');
        $where['IDIde'] = $idSkripsi;

        $pengirim = $_SESSION['ID'];
        $tanggal = date('Y-m-d');

        $ideSkripsi = $this->M_data->find('ideskripsi', $where, '', '', 'users', 'users.ID = ideskripsi.IDIdeMahasiswa');

        foreach ($ideSkripsi->result() as $d) {
            $IDIde = $d->IDIde;
            $judul = $d->JudulIde;
            $deskripsi = $d->DeskripsiIde;
            $ID = $d->ID;
            $nama = $d->Nama;
        }

        if (!is_dir('./assets/images/QRCode')) {
            mkdir('./assets/images/QRCode');
        }

        if ($sta === 'true') {

            $hasil = 'Ditolak';

            $whereIde = array('IDIde' => $IDIde);

            $this->M_data->delete($whereIde, 'ideskripsi');

        } else {

            $this->load->library('ciqrcode');

            $config['cacheable'] = true;
            $config['cachedir'] = './assets/';
            $config['errorlog'] = './assets/';
            $config['imagedir'] = './assets/images/QRCode/';
            $config['quality'] = true;
            $config['size'] = '1024';
            $config['black'] = array(224, 255, 255);
            $config['white'] = array(70, 130, 180);
            $this->ciqrcode->initialize($config);

            $params['data'] = base_url('Cetak/kartu/' . $ID);
            $params['level'] = 'H';
            $params['size'] = 10;
            $params['savename'] = FCPATH . $config['imagedir'] . $ID . '.png';

            $this->ciqrcode->generate($params);

            $sh = array('IDSkripsi' => $IDIde, 'JudulSkripsi' => $judul, 'QRCode' => $ID . '.png', 'Deskripsi' => $deskripsi, 'IDMahasiswaSkripsi' => $ID, 'Tanggal' => $tanggal);
            $this->M_data->save($sh, 'skripsi');

            for ($i = 1; $i < 3; $i++) {

                $pmb = $this->input->post('pmb' . $i);

                // Memasukan Dosen Pembimbing Ke Database
                $dosen = array('IDDosenPmb' => $pmb, 'IDSkripsiPmb' => $IDIde, 'StatusProposal' => 0, 'StatusSkripsi' => 0, 'StatusPembimbing' => $i);
                $this->M_data->save($dosen, 'pembimbing');

                // Mengirim Pemberitahuan Ke Dosen Pembimbing
                $Catatan = 'Anda Di Tetapkan Sebagai Dosen Pembimbing ' . $nama . ' Anda sekarang bisa mengacc proposal maupun skripsi ' . $nama . 'dan juga menambah kartu bimbingan untuk mahasiswa tersebut Anda ditetapkan sebagai pembimbing ke ' . $i;

                $NotifDosen = array('Notifikasi' => $judul, 'Catatan' => $Catatan, 'TanggalNotifikasi' => $tanggal, 'IDPengirim' => $pengirim, 'IDPenerima' => $pmb, 'StatusNotifikasi' => 'Informasi');
                $this->M_data->save($NotifDosen, 'notifikasi');

            }

            $whereIde = array('IDIdeMahasiswa' => $ID);

            $this->M_data->delete($whereIde, 'ideskripsi');

            $hasil = 'Diterima';

        }

        echo $sta;

        $NotifMhs = array('Notifikasi' => $judul, 'Catatan' => $note, 'TanggalNotifikasi' => $tanggal, 'IDPengirim' => $pengirim, 'IDPenerima' => $ID, 'StatusNotifikasi' => $hasil);
        $this->M_data->save($NotifMhs, 'notifikasi');

    }

    public function aksiKegiatan()
    {
        $kegiatan = $this->input->post('kegiatan');
        $jam = $this->input->post('jam');
        $tempat = $this->input->post('tempat');
        $penerima = $this->input->post('penerima');
        $tanggal = $this->input->post('tanggal');

        foreach ($penerima as $p) {

            $data = array(
                'Notifikasi' => 'Kegiatan ' . $kegiatan . ' Telah Ditetapkan',
                'Catatan' => 'Dimohon Persiapkan diri Pada : <br> <i class="fas fa-clock mr-auto"></i>  ' . $jam . '<br> <i class="fas fa-map-marker mr-auto"></i>  ' . $tempat . '<br> <i class="fas fa-calendar-alt"></i> ' . longdate_indo($tanggal),
                'IDPengirim' => $_SESSION['ID'],
                'IDPenerima' => $p,
                'TanggalNotifikasi' => date('Y-m-d'),
                'StatusNotifikasi' => $kegiatan,
            );

            $this->M_data->save($data, 'notifikasi');

        }

        // $simpan = array(
        //   'IDUsers' => $penerima,
        //   'Kegiatan' => $kegiatan,
        //   'Tempat' => $tempat,
        //   'JamKegiatan' => $jam,
        //   'TanggalKegiatan' => $tanggal,
        //   'Finish' => 0,
        // );

        // $this->M_data->save($simpan, 'kegiatan');

    }

    function dokumentasi()
    {
        $kaprodi = $this->M_data->find('users', array('ID' => $_SESSION['ID']));

        foreach ($kaprodi->result() as $k) {
            $where = array('Status' => 'Alumni', 'IDKonsentrasiUser' => $k->IDKonsentrasiUser);
        }

        $data['users'] = $this->M_data->find('skripsi', $where, '', '', 'users', 'users.ID = skripsi.IDMahasiswaSkripsi');

        $this->load->view('kaprodi/dokumentasi', $data);
    }
}
