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

class Mahasiswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $status = $this->session->userdata('Status');
        if (!(($status == "Mahasiswa") or ($status == "Skripsi"))) {
            redirect(base_url("Home"));
        }
    }

    public function index()
    {
        $where = array('IDPenerima' => $_SESSION['ID']);
        $skrip = array('IDMahasiswaSkripsi' => $_SESSION['ID']);
        $data['pemberitahuan'] = $this->M_data->find('notifikasi', $where, 'IDNotifikasi', 'DESC', 'users', 'users.ID = notifikasi.IDPengirim');
        $whereUsers = array('ID' => $_SESSION['ID']);
        $data['users'] = $this->M_data->find('users', $whereUsers, '', '', 'jurusan', 'jurusan.IDJurusan = users.IDJurusanUser');

        $data['skripsi'] = $this->M_data->find('skripsi', $skrip);
        $this->load->view('template/navbar')->view('mahasiswa/home', $data);
    }

    public function sendIde()
    {
        $id_ide = time();
        $judul = $this->input->post('judul');
        $deskripsi = $this->input->post('deskripsi');
        $tanggal = longdate_indo(date('Y-m-d'));
        $nim = $_SESSION['ID'];

        $ide = array('IDIde' => $id_ide, 'IDIdeMahasiswa' => $nim, 'JudulIde' => $judul, 'DeskripsiIde' => $deskripsi, 'Tanggalide' => $tanggal);

        $where = array('JudulSkripsi' => $judul);

        $skripsi = $this->M_data->find('skripsi', $where);

        if ($skripsi) {
            $notif = array(
                'head' => 'Ide skripsi gagal diajukan!',
                'isi' => 'Judul skripsi yang sama sudah pernah ada',
                'sukses' => 0,
            );
        } else {
            $this->M_data->save($ide, 'ideskripsi');
            $notif = array(
                'head' => 'Ide skripsi berhasil diajukan!',
                'isi' => 'Silahkan tunggu validasi dari kaprodi',
                'ID' => 'ideSkripsi',
                'func' => 'Mahasiswa/ideSkripsi',
                'sukses' => 1,
            );
        }

        echo json_encode($notif);
    }

    public function form_ide()
    {
        $this->load->view('mahasiswa/formIde');
    }

    function ideSkripsi()
    {
        $where = array('IDIdeMahasiswa' => $_SESSION['ID']);
        $data['ide_skripsi'] = $this->M_data->find('ideskripsi', $where, 'IDIde', 'DESC');
        $this->load->view('mahasiswa/ideSkripsi', $data);
    }

    public function mySkripsi()
    {
        $whereSK = array('IDMahasiswaSkripsi' => $_SESSION['ID']);
        $data['skripsi'] = $this->M_data->find('skripsi', $whereSK, '', '', 'users', 'users.ID = skripsi.IDSkripsi');
        $whereKB = array('IDKartuMahasiswa' => $_SESSION['ID']);
        $data['konsultasi'] = $this->M_data->find('kartubimbingan', $whereKB, '', '', 'users', 'users.ID = kartubimbingan.IDKartuMahasiswa');

        $nim = $_SESSION['ID'];

        foreach ($data['skripsi']->result() as $s) {
            $proposal = true;
            $ID = $s->IDSkripsi;
            $where = array(
                'IDSkripsiPmb' => $ID,
                'StatusProposal' => $proposal,
            );
            $data['pmb'] = $this->M_data->find('pembimbing', $where);

        }

        foreach ($data['skripsi']->result() as $m) {
            $wherePmb = array('IDSkripsiPmb' => $m->IDSkripsi);
            $data['pembimbing'] = $this->M_data->find('pembimbing', $wherePmb, '', '', 'users', 'users.ID = pembimbing.IDDosenPmb');
        }

        $this->load->view('template/jquery/formSubmit');
        $this->load->view('mahasiswa/mySkripsi', $data);
    }

    public function uploadData($sesi, $ID)
    {

		$config['upload_path'] = './assets/' . $sesi . '/';
		$config['allowed_types'] = 'pdf';
		$config['overwrite'] = true;
		$config['max_size'] = 0;
        $config['file_name'] = $ID;

        if (!is_dir('./assets/' . $sesi)) {
            mkdir('./assets/' . $sesi);
        }

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($sesi)) {
            $notif = array('head' => "maaf terjadi kesalahan teknis",
                'isi' => $this->upload->display_errors(),
                'sukses' => 0);

        } else {
        
            $file = $this->upload->data();
            $data = array('File' . $sesi => $file['file_name']);
            if ($this->M_data->update('IDSkripsi', $ID, 'skripsi', $data)) {

                $notif = array(
                    'head' => "File " . $sesi . " Berhasil di Upload",
                    'isi' => "Silahkan minta dosen untuk cek proposal anda",
                    'ID' => "MySkripsi",
                    'func' => "/Mahasiswa/mySkripsi",
                    'sukses' => 1,

                );
            } else {
                $notif = array(
                    'head' => "File " . $sesi . " Tidak Berhasil di Upload",
                    'isi' => "Maaf Terjadi Kesahalah Teknis",
                    'sukses' => 0);
            }
        }
        echo json_encode($notif);
    }

}
