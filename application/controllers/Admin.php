<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('Status') != "Admin") {
            redirect(base_url("Home"));
        }
        $this->load->library('Ajax_pagination');
        $this->perPage = 4;
    }

    public function index()
    {
        $data['konsentrasi'] = $this->M_data->find('konsentrasi');
        $this->load->view('template/navbar');
        $this->load->view('admin/home', $data);
    }

    public function navigasiUsers($nav)
    {

        $where = $nav == 'Mahasiswa' ? "Status='Mahasiswa' OR Status='Skripsi'" : "Status='Dosen'";
        if ($nav != 'Settings') {
            $data['users'] = $this->M_data->find('users', $where);
            $data['nav'] = $nav;
        } else {
            $data = '';
        }

        $this->load->view('admin/nav/' . $nav, $data);
    }

    public function formJurusan()
    {
        $this->load->view('admin/form/Jurusan');
        $this->load->view('template/jquery/formSubmit');
    }

    public function formKonsentrasi()
    {
        $where = array('Status' => 'Dosen');

        $data['result'] = 'Data Jurusannya Dimasukan Dulu Oh, min :(';
        $data['jurusan'] = $this->M_data->find('jurusan');
        $data['users'] = $this->M_data->find('users', $where);

        $this->load->view('admin/form/Konsentrasi', $data);
        $this->load->view('template/jquery/formSubmit');
    }

    public function formKaprodi($id)
    {
        $where = array('IDKonsentrasiUser' => $id, 'Status' => 'Dosen');
        $data['dosen'] = $this->M_data->find('users', $where);
        $data['ID'] = $id;
        $this->load->view('admin/form/Kaprodi', $data);
    }

    public function formUsers($user)
    {
        $data['konsentrasi'] = $this->M_data->find('konsentrasi');
        $data['jurusan'] = $this->M_data->find('jurusan');
        $data['user'] = $user;
        $this->load->view('admin/form/Users', $data);
        $this->load->view('template/jquery/formSubmit');
    }

    public function tabelJrsnAdmin()
    {
        $data['jurusan'] = $this->M_data->find('jurusan');
        $this->load->view('admin/tabel/Jurusan', $data);
    }

    public function tabelKonsentrasiAdmin($id)
    {
        $where = array('IDJurusanKsn' => $id);

        $data['konsentrasi'] = $this->M_data->find('konsentrasi', $where, '', '', 'users', 'users.ID = konsentrasi.IDDosen');

        if ($data['konsentrasi']) {
            foreach ($data['konsentrasi']->result() as $k) {
                $whereUsers = array(
           //       'IDKonsentrasiUser' => $k->IDKonsentrasi,
                    'Status' => 'Dosen',
                );
            }
            $data['users'] = $this->M_data->find('users', $whereUsers);
        } else {
            $data['users'] = 'Tidak Ditemukan Konsentrasi';
        }

        $this->load->view('admin/tabel/Konsentrasi', $data);

    }

    public function submitKaprodi($id)
    {
        $where = array(
            'IDKonsentrasi' => $id,
        );

        $data['IDDosen'] = $this->input->post('kaprodi');

        $this->M_data->update('IDKonsentrasi', $id, 'konsentrasi', $data);
        redirect('Admin');
    }

    public function tabelNavigasi($page, $user)
    {
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }

        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        $search = $this->input->post('search');

        if (!empty($keywords)) {
            $conditions['search']['keywords'] = $keywords;
        }
        if (!empty($sortBy)) {
            $conditions['search']['sortBy'] = $sortBy;
        }
        if ($user != 'Daftar') {
            $conditions['start'] = $offset;
            $conditions['limit'] = $this->perPage;
        } else {
            $conditions['start'] = '';
            $conditions['limit'] = '';
        }

        if ($user === 'Mahasiswa') {
            $where = "(Status='Mahasiswa' OR Status='Skripsi')";
        } else {
            $where['Status'] = $user;
        }

        $data['users'] = $this->M_data->find('users', $where, '', '', 'jurusan', 'jurusan.IDJurusan = users.IDJurusanUser', 'konsentrasi', 'konsentrasi.IDKonsentrasi = users.IDKonsentrasiUser', '', '', $conditions, $search);

        $total = $this->M_data->find('users', $where, '', '', 'jurusan', 'jurusan.IDJurusan = users.IDJurusanUser', 'konsentrasi', 'konsentrasi.IDKonsentrasi = users.IDKonsentrasiUser');

        if ($data['users']) {

            $data['jurusan'] = $this->M_data->find('jurusan');

            $wherekonsentrasi = array(
              'IDJurusanKsn' => $data['users']->row()->IDJurusanUser   
          );

            $data['konsentrasi'] = $this->M_data->find('konsentrasi', $wherekonsentrasi);

        }


        $totalRec = $total != false ? $total->num_rows() : 0;
        $config['target'] = '#tabelUsers';
        $config['base_url'] = base_url() . 'Admin/tabelNavigasi/' . $page . '/' . $user;
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'search' . $user;

        $user === 'Daftar' ? '' : $this->ajax_pagination->initialize($config);


        $data['status'] = $user;



        $this->load->view('admin/tabel/Users', $data, false);
        $this->load->view('template/jquery/btnSubmit');
    }

    public function delete_dosen($nik)
    {
        $where = array('ID' => $nik);
        $cek = $this->M_data->find('users', $where);

        foreach ($cek->result() as $c) {
            unlink('./assets/images/User/' . $c->foto_dsn);
            $this->M_data->delete($where, 'users');
        }
    }

    public function saveJurusan()
    {
        $data['IDJurusan'] = $this->input->post('id_jurusan');
        $data['Jurusan'] = $this->input->post('jurusan');

        $this->M_data->save($data, 'jurusan');

        $notif = array(
            'head' => 'Data Berhasil Disimpan',
            'isi' => 'Jurusan Telah DiSimpan Silahkan Isi Konsentrasi Untuk Jurusan Yang Baru DiBuat',
            'sukses' => 1,
            'ID' => 'JurusanAdmin',
            'func' => 'Admin/tabelJrsnAdmin',
        );
        echo json_encode($notif);
    }

    public function saveKonsentrasi()
    {
        $prodi = $this->input->post('prodi');
        $data['IDKonsentrasi'] = $this->input->post('id');
        $data['konsentrasi'] = $this->input->post('konsentrasi');
        $data['IDJurusanKsn'] = $this->input->post('id_jurusan');
        $data['IDDosen'] = $prodi === null ? '' : $prodi;
        $this->M_data->save($data, 'konsentrasi');
        $notif = array(
            'head' => 'Data Berhasil Disimpan',
            'isi' => 'Konsentrasi Telah Di Simpan',
            'sukses' => 1,
            'ID' => 'JurusanAdmin',
            'func' => 'Admin/tabelJrsnAdmin',
        );
        echo json_encode($notif);
    }

    private function sendEmail($email, $nama, $password)
    {
        $this->email->from('umusbrebes@gmail.com', 'Universitas Muhadi Setiabudi');
        $this->email->to($email);

        $this->email->subject('Sistem Informasi Skripsi');
        $this->email->message('Selamat Datang ' . $nama . ' di Universitas Muhadi Setiabudi. Sekarang anda bisa login sistem informasi skripsi dengan menggunakan ID anda. Password : ' . $password . '  Semoga harimu menyenangkan.');

        return $this->email->send();

    }

    private function imageProses($path)
    {

        $config['image_library'] = 'gd2';
        $config['source_image'] = './assets/images/User/' . $path;
        $config['create_thumb'] = false;
        $config['maintain_ratio'] = true;
        $config['width'] = 300;
        $config['height'] = 300;

        $this->load->library('image_lib', $config);
        return $this->image_lib->resize();
    }

    public function sendPassword($id)
    {
        $where = array('ID' => $id);
        $user = $this->M_data->find('users', $where);
        foreach ($user->result() as $u) {
            $nama = $u->Nama;
            $email = $u->Email;
        }
        $password = random_string('alnum', 12);
        if ($this->sendEmail($email, $nama, $password)) {
            $data = array('Password' => md5($password));
            $this->M_data->update('ID', $id, 'users', $data);
            echo "Password Telah di Kirim ke Email Pengguna";
        } else {
            echo "Password Gagal diKirim Periksa Server Anda";
        }
    }

    public function saveUsers($user) // Menyimpan Form Dosen

    {
        $id = $this->input->post('id');
        $nama = $this->input->post('name');
        $email = $this->input->post('email');
        $jurusan = $this->input->post('id_jurusan');
        $konsentrasi = $this->input->post('konsentrasi');

        $data = array(
            'ID' => $id,
            'Nama' => $nama,
            'Email' => $email,
            'IDKonsentrasiUser' => $konsentrasi,
            'IDJurusanUser' => $jurusan,
            'Password' => md5('12345'),
            'Status' => $user,
        );

        $this->M_data->save($data, 'users');

        $notif = array(
            'head' => 'Data Berhasil Ditambahkan',
            'isi' => 'Silahkan Ke Bagian Tabel Untuk Mengirim Password Untuk '.$user,
            'sukses' => 1,
            'ID' => $user,
            'func' => 'Admin/tabelNavigasi/0/'.$user,
        );

        echo json_encode($notif);
    }

    public function acceptDaftar($ID, $disetujui)
    {
        if ($disetujui === 'true') {

            $data['Status'] = 'Mahasiswa';
            $this->M_data->update('ID', $ID, 'users', $data);

            $this->imageProses($result->Foto);
            echo "Pendaftaran Diterima";

        } else {

            $where = array('ID' => $ID);
            $cek = $this->M_data->find('users', $where);

            foreach ($cek->result() as $c) {
                if ($this->M_data->delete($where, 'users')) {
                    echo "Pendaftaran Ditolak";
                    unlink('./assets/images/User/' . $c->Foto);
                }
            }

        }
    }

    public function filterKaprodi()
    {
        $id_jurusan = $this->input->post('id_jurusan');
        $where = array(
            'IDJurusanUser' => $id_jurusan,
            'Status' => 'Dosen',
        );
        $data = $this->M_data->find('users', $where);

        if ($data) {
            $lists = "<option value=''> Pilih Kaprodi </option>";
            foreach ($data->result() as $d) {
                $lists .= "<option value='" . $d->ID . "'>" . $d->Nama . "</option>";
            }
        } else {
            $lists = "<option value=''>Dosen Tidak Ada </option>";
        }

        $callback = array('list' => $lists);
        echo json_encode($callback);
    }

    public function statusSkripsi($ID)
    {
        $data['Status'] = 'Skripsi';
        if (!$this->M_data->update('ID', $ID, 'users', $data)) {
            echo 0;
        } else {
            echo 'Status Mahasiswa Berhasil Diubah';
        }

    }

    function updateUser()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $jurusan = $this->input->post('jurusan');
        $konsentrasi = $this->input->post('konsentrasi');
        $email = $this->input->post('email');
        $nohp = $this->input->post('nohp');
        $idlama = $this->input->post('idlama');

        $data = array('ID' => $id, 'Nama' => $name, 'IDJurusanUser' => $jurusan, 'IDKonsentrasiUser' => $konsentrasi, 'Email' => $email, 'NoHP' => $nohp );

        $this->M_data->update('ID', $idlama, 'users', $data);
    }

    public function update()
    {
        $id = $this->input->post("id");
        $value = $this->input->post("value");
        $modul = $this->input->post("modul");
        $data[$modul] = $value;
        $this->M_data->update('ID', $id, 'users', $data);
        echo "{}";
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
