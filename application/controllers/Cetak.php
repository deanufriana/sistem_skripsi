<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Pdf');
	}


	public function index()
	{
		$pdf = new FPDF('P','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Times', 'B', 12);
		$pdf->Cell(0, 0, 'FORMULIR PENGAJUAN JUDUL SKRIPSI', 0,0,'C');
		$pdf->Ln(15);
		$pdf->SetFont('Times', '', 12);
		$pdf->Cell(0, 0, 'Kepada Yth,', 0,0,'L');
		$pdf->Cell(0, 0, 'Brebes,.../.../2018', 0,0,'R');
		$pdf->ln(5);
		$pdf->Cell(0, 0, 'Bapak : Nur Ariesanto, M.Kom', 0,0,'L');
		$pdf->ln(5);
		$pdf->Cell(0, 0, 'Ka. Prodi Teknik Informatika', 0,0,'L');
		$pdf->ln(5);
		$pdf->Cell(0, 0, 'Univesitas Muhadi Setiabudi Brebes', 0,0,'L');
		$pdf->ln(5);
		$pdf->Cell(0, 0, 'Di', 0,0,'L');
		$pdf->ln(5);
		$pdf->Cell(0, 0, 'Tempat', 0,0,'L');
		$pdf->ln(10);
		$pdf->Cell(0, 0, 'Dengan hormat,', 0,0,'L');
		$pdf->ln(5);
		$pdf->Cell(20, 0, '', 0,0,'L');
		$pdf->Cell(0,0,'Saya yang bertanda tangan dibawah ini:',0,1,'L');
		$pdf->ln(5);
		$pdf->Cell(0, 0, 'Nama 	   : .............', 0,0,'L');
		$pdf->ln(5);
		$pdf->Cell(0, 0, 'NIM 	     : .............', 0,0,'L');
		$pdf->ln(5);
		$pdf->MultiCell(0,5,'Berhubung dengan telah selesainya semua persyaratan Akademik & Administrasi / Keuangan dan yang lainnya maka dengan ini saya mengajukan permohonan judul untuk Skripsi pada semester ini.',0,'J');
		$pdf->ln(3);
		$pdf->Cell(0, 0, 'Adapun bukti yang saya lampirkan untuk bahan pertimbangan bapak: ', 0,0,'L');
		$pdf->ln(10);
		$pdf->Cell(0, 0, '1. Foto Copy KHS                : 1 Lembar (SKS Mencukupi)', 0,0,'L');
		$pdf->ln(5);
		$pdf->Cell(0, 0, '2. Foto Copy KRS                : 1 Lembar (Mata Kuliah Berjalan)', 0,0,'L');
		$pdf->ln(5);
		$pdf->Cell(0, 0, '3. Foto Copy Uang Skripsi		 : 1 Lembar (FT)', 0,0,'L');
		$pdf->ln(10);
		$pdf->Cell(0, 0, 'Adapun judul yang akan saya ajukan:', 0,0,'L');
		$pdf->ln(5);
		$pdf->MultiCell(0,5,'...........................................................................................................................................................................................................................................................................................................................',0,'J');
		$pdf->ln(5);
		$pdf->MultiCell(0,5,'Adapun judul yang saya ajukan adalah judul yang menurut saya bisa diselesaikan tepat waktu dan telah melakukan konsultasi dengan beberapa dosen di Universitas Muhadi Setiabudi Brebes, dan dengan alasan ini saya sekalian mengajukan permohonan untuk dosen Pembimbing Skripsi (Formulir Pengajuan Pembimbing)',0,'J');
		$pdf->ln(5);
		$pdf->MultiCell(0,5,'Demikian isi dari Surat Permohonan ini saya buat, besar harapan saya bapak dapat mengabulkannya dan mengeluarkan SK Pembimbing untuk pelaksanaan Skripsi tersebut. Atas kesedian dan pertimbangan bapak saya ucapkan terimakasih.',0,'J');
		$pdf->ln(10);
		$pdf->Cell(150, 0, '', 0,0,'L');
		$pdf->Cell(0, 0, 'Hormat Saya,', 0,0,'L');
		$pdf->ln(5);
		$pdf->Cell(150, 0, '', 0,0,'L');
		$pdf->Cell(0, 0, 'Mahasiswa', 0,0,'L');
		$pdf->ln(20);
		$pdf->Cell(150, 0, '', 0,0,'L');
		$pdf->Cell(0, 0, 'Devi Adi Nufriana', 0,0,'L');
		$pdf->ln(5);
		$pdf->Cell(0, 0, 'Dosen Konsultasi Judul:', 0,0,'L');
		$pdf->ln(5);
		$pdf->Cell(0, 0, '1.', 0,0,'L');
		$pdf->ln(15);
		$pdf->SetFont('Times', 'U', 12);
		$pdf->Cell(0, 0, 'Jayanto. S.pd', 0,0,'L');
		$pdf->ln(5);
		$pdf->SetFont('Times', '', 12);
		$pdf->Cell(0, 0, 'NIK.Y', 0,0,'L');
		$pdf->ln(10);
		$pdf->Cell(0, 0, '2.', 0,0,'L');
		$pdf->ln(15);
		$pdf->SetFont('Times', 'U', 12);
		$pdf->Cell(0, 0, 'Bagas. S.pd', 0,0,'L');
		$pdf->ln(5);
		$pdf->SetFont('Times', '', 12);
		$pdf->Cell(0, 0, 'NIK.Y', 0,0,'L');
		
		$pdf->Output();
	}

	/*public function suratpenunjukan()
	{
		$pdf = new FPDF('P','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Times', 'BU', 12);
		$pdf->Cell(0, 0, 'SURAT PENUNJUKAN DOSEN PEMBIMBING', 0,0,'C');
		$pdf->SetFont('Times', 'B', 12);
		$pdf->ln(6);
		$pdf->Cell(0, 0, 'Nomor:______________________________', 0,0,'C');
		$pdf->ln(20);
		$pdf->SetFont('Times', '', 12);
		$pdf->Cell(20, 0, '', 0,0,'L');
		$pdf->Cell(0,0,'Sehubung dengan kegiatan penyusunan skripsi oleh mahasiswa,',0,1,'L');
		$pdf->ln(10);
		$pdf->Cell(30, 0, 'NIM', 0,0,'L');
		$pdf->Cell(0, 0, ': 55201140012', 0,0,'L');	
		$pdf->ln(10);
		$pdf->Cell(30, 0, 'Nama', 0,0,'L');
		$pdf->Cell(0, 0, ': Devi Adi Nufriana', 0,0,'L');
		$pdf->ln(7);
		$pdf->Cell(30, 5, 'Judul Sementara', 0,0,'L');
		$pdf->MultiCell(0, 5, ': Rancang Bangun Sistem Informasi Skripsi Berbasis Web di Universitas Muhadi Setiabudi Brebes', 0,'J');
		$pdf->ln(7);
		$pdf->Cell(0, 0, 'Pada Semester : Ganjil/Genap Tahun akademik : .................../.................', 0,0,'L');
		$pdf->ln(7);
		$pdf->Cell(0, 0, 'dengan ini kami mohon bantuan kepada :', 0,0,'L');
		$pdf->ln(7);
		$pdf->Cell(0, 0, 'Bapak/Ibu ........................................', 0,0,'L');
		$pdf->ln(7);
		$pdf->MultiCell(0,7,'Untuk bersedia menjadi pembimbing mahasiswa tersebut. Pembimbing dimaksudkan bertindak sebagai pemberi masukan dan pengarah materi skripsi agar layak dan berbobot sesuai dengan jenjang S1. Selain itu juga bertindak sebagai pengarah sistematika dan tata bahasa Indonesia bagi mahasiswa dalam menulis skripsi. Atas bantuan dan bimbingan yang diberikan, kami mengucapkan terimakasih.',0,'J');
		$pdf->ln(20);
		$pdf->Cell(130, 0, '', 0,0,'L');
		$pdf->Cell(0, 0, 'Brebes, 27 Desember 2018,', 190,0,'L');
		$pdf->ln(25);
		$pdf->Cell(130, 0, '', 0,0,'L');
		$pdf->Cell(181, 0, 'Nur Ariesanto R, M.Kom', 0,2,'L');
		$pdf->ln(5);
		$pdf->Cell(130, 0, '', 0,0,'L');
		$pdf->Cell(0, 0, 'Ka. Prodi Teknik Informatika', 0,0,'L');
		$pdf->Output();
	}*/

	public function kartu($nim)
	{
		$where = array('nim' => $nim);
		$where1 = array('nim_mhs_ks' => $nim);
		$data = $this->M_data->find('konsultasi', $where1);
		$mhs = $this->M_data->find('mahasiswa', $where, '', '', '', '', 'jurusan', 'jurusan.id_jurusan = mahasiswa.id_jurusan_mhs', 'konsentrasi', 'konsentrasi.id = mahasiswa.id_konsentrasi_mhs', 'skripsi', 'skripsi.id_skripsi = mahasiswa.id_skripsi_mhs');
		$pdf = new Pdf('P','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Times', 'BU', 12);
		$pdf->Cell(0, 0, 'KARTU KONSULTASI', 0,0,'C');
		$pdf->ln(10);
		$pdf->SetFont('Times', '', 12);
		foreach ($mhs->result() as $m) {
			$pdf->Cell(30, 5, 'Nama', 0,0,'L');
			$pdf->Cell(0, 5, ': '.$m->nama_mhs, 0,0,'L');	
			$pdf->ln(7);
			$pdf->Cell(30, 5, 'NIM', 0,0,'L');
			$pdf->Cell(0, 5, ': '.$m->nim, 0,0,'L');
			$pdf->ln(7);
			$pdf->Cell(30, 5, 'Jurusan', 0,0,'L');
			$pdf->Cell(0, 5, ': '.$m->jurusan, 0,'J');
			$pdf->ln(7);       
			$pdf->Cell(30, 5, 'Konsentrasi', 0,0,'L');
			$pdf->Cell(0, 5, ': '.$m->konsentrasi, 0,'J');
			$pdf->ln(7);
			$pdf->Cell(30, 5, 'Judul', 0,0,'L');
			$pdf->MultiCell(0, 5, ': '.$m->judul_skripsi
				, 0,'J');
			$pdf->Image(base_url('assets/images/'.$m->QR_Code),170,6,30);
		}
		$pdf->ln(10);
		$pdf->Cell(10,7,'No',1);		
		$pdf->Cell(45,7,'Tanggal', 1);
		$pdf->Cell(70,7,'Catatan', 1);
		$pdf->Cell(65,7,'Pembimbing', 1);
		$pdf->Ln();
		$no = 1;
		$pdf->SetWidths(array(10,45,70,65));
		/*srand(microtime()*1000000);*/
		foreach ($data->result() as $d) {
		
		for($i=0;$i<1;$i++)
			$pdf->Row(array($no++,longdate_indo($d->tanggal),$d->catatan,$d->pembimbing));
		}

		$pdf->ln(20);
		$pdf->Cell(130, 0, '', 0,0,'L');
		$pdf->Cell(0, 0, 'Brebes, '.date_indo(date('Y-m-d')), 190,0,'L');
		$pdf->ln(25);
		$pdf->Cell(130, 0, '', 0,0,'L');
		foreach ($mhs->result() as $k) {
			$where = array('id' => $k->id_konsentrasi_mhs);
			$jurusan = $this->M_data->find('konsentrasi', $where, '', '', '', '', 'dosen', 'dosen.nik = konsentrasi.nik_kaprodi', 'jurusan', 'jurusan.id_jurusan = konsentrasi.id_jurusan_ksn');	
		}
		foreach ($jurusan->result() as $j) {
			$pdf->Cell(181, 0, $j->nama_dosen, 0,2,'L');
			$pdf->ln(5);
			$pdf->Cell(130, 0, '', 0,0,'L');
			$pdf->Cell(0, 0, 'Ka. Prodi '.$j->jurusan.' '.$j->konsentrasi, 0,0,'L');
		}
		$pdf->Output();
	}
}
/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */