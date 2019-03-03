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

	public function kartu($nim)
	{
		$where = array('ID' => $nim);
		$where1 = array('IDKartuMahasiswa' => $nim);
		$data = $this->M_data->find('kartubimbingan', $where1, '', '', 'users', 'users.ID = kartubimbingan.IDDosenPembimbing');

		$where2 = array('IDMahasiswaSkripsi' => $nim);
		
		$skripsi = $this->M_data->find('skripsi', $where2);
		
		$mhs = $this->M_data->find('users', $where,'', '', 'jurusan', 'jurusan.IDJurusan = users.IDJUrusanUser', 'konsentrasi', 'konsentrasi.IDKonsentrasi = users.IDKonsentrasiUser');
		$pdf = new Pdf('P','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Times', 'BU', 12);
		$pdf->Cell(0, 0, 'KARTU KONSULTASI', 0,0,'C');
		$pdf->ln(10);
		$pdf->SetFont('Times', '', 12);
		foreach ($mhs->result() as $m) {
			$pdf->Cell(30, 5, 'Nama', 0,0,'L');
			$pdf->Cell(0, 5, ': '.$m->Nama, 0,0,'L');	
			$pdf->ln(7);
			$pdf->Cell(30, 5, 'NIM', 0,0,'L');
			$pdf->Cell(0, 5, ': '.$m->ID, 0,0,'L');
			$pdf->ln(7);
			$pdf->Cell(30, 5, 'Jurusan', 0,0,'L');
			$pdf->Cell(0, 5, ': '.$m->Jurusan, 0,'J');
			$pdf->ln(7);       
			$pdf->Cell(30, 5, 'Konsentrasi', 0,0,'L');
			$pdf->Cell(0, 5, ': '.$m->Konsentrasi, 0,'J');
			$pdf->ln(7);
			$pdf->Cell(30, 5, 'Judul', 0,0,'L');
			foreach ($skripsi->result() as $s) {
				$pdf->MultiCell(0, 5, ': '.$s->JudulSkripsi
					, 0,'J');
				if (file_exists('assets/images/QRCode/'.$s->QRCode)) {
					$pdf->Image(base_url('assets/images/QRCode/'.$s->QRCode),170,6,30);
				}
			}
		}
		$pdf->ln(10);
		/*srand(microtime()*1000000);*/
		if ($data) {

			$pdf->Cell(10,7,'No',1);		
			$pdf->Cell(45,7,'Tanggal', 1);
			$pdf->Cell(70,7,'Catatan', 1);
			$pdf->Cell(65,7,'Pembimbing', 1);
			$pdf->Ln();
			$no = 1;
			$pdf->SetWidths(array(10,45,70,65));
			foreach ($data->result() as $d) {

				for($i=0;$i<1;$i++)
					$pdf->Row(array($no++,longdate_indo($d->TanggalBimbingan),$d->Catatan,$d->Nama));
			}		
		} else {
			$pdf->MultiCell(100,7, 'Tidak Ditemukan Catatan Bimbingan Dosen Untuk Skripsi Ini', 0);
		}


		$pdf->Cell(120, 0, '', 0,0,'L');
		$pdf->Cell(0, 35, 'Brebes, '.date_indo(date('Y-m-d')), 0,2,'L');

		foreach ($mhs->result() as $k) {
			$where = array('IDKonsentrasi' => $k->IDKonsentrasiUser);
			$jurusan = $this->M_data->find('konsentrasi', $where,  '', '', 'users', 'users.ID = konsentrasi.IDDosen', 'jurusan', 'jurusan.IDJurusan = konsentrasi.IDJurusanKsn');	
		}
		foreach ($jurusan->result() as $j) {
			$pdf->Cell(0, 9, $j->Nama, 0,2,'L');
			$pdf->Cell(0, 0, 'Ka. Prodi '.$j->Jurusan.' '.$j->Konsentrasi, 0,2,'L');
		}
		$pdf->Output();
	}
}
/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */