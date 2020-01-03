<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
class report extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
        parent::__construct();

        // Load form helper library
        $this->load->helper('form');

        // Load session library
        $this->load->library('session');

        // Load form validation library
        $this->load->library('form_validation');

		$this->load->library('pdf');

		$this->load->helper('file');

		$this->load->helper('download');

		$this->load->dbutil();

        // Load database
 		$this->load->database();
        $this->load->model('tuser');
        $this->load->model('laporan');
	}

	public function absensi_detail()
	{
		$data['title']="Report Absensi Detail";
		$this->load->model('menu');
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
        $this->form_validation->set_rules('bulan', 'Bulan Awal', 'required');
        $this->form_validation->set_rules('tanggal', 'Bulan Akhir', 'required');
		$this->form_validation->set_rules('jenis', 'Pekerja', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['data'] = false;
			$data['postData'] = false;
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $menu);
			$this->load->view('r_laporan absensi detail', $data);
			$this->load->view('templates/footer');
		}else{
			$tahun = $this->input->post('tahun');
			$bulan = $this->input->post('bulan');
			$tanggal = $this->input->post('tanggal');
			$jenis = $this->input->post('jenis');
			if ($bulan === 'ALL') {
				$typePosisi = 3;
				$posisi = $tahun;
			}
			elseif ($tanggal === 'ALL'&& $bulan != 'ALL') {
				$typePosisi = 1;
				$posisi = $tahun.'-'.$bulan;
			}else {
				$typePosisi = 2;
				$posisi = $tahun.'-'.$bulan.'-'.$tanggal;
			}
			$data['typePosisi']=$typePosisi;
			$data['kode']=$jenis;
			$data['posisi']=$posisi;
			$result['data']=$this->laporan->sp_absensi_detail($data);
			$result['postData'] = $this->input->post();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $menu);
			$this->load->view('r_laporan absensi detail', $result);
			$this->load->view('templates/footer');
		}
	}

	public function pdf_report_absensidetail()
	{
        $this->form_validation->set_rules('bulan', 'Bulan Awal', 'required');
        $this->form_validation->set_rules('tanggal', 'Bulan Akhir', 'required');
		$this->form_validation->set_rules('jenis', 'Pekerja', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['data'] = false;
			redirect('/report/absensi_detail');
		}else{
			$tahun = $this->input->post('tahun');
			$bulan = $this->input->post('bulan');
			$tanggal = $this->input->post('tanggal');
			$jenis = $this->input->post('jenis');
			if ($bulan === 'ALL') {
				$typePosisi = 3;
				$posisi = $tahun;
			}
			elseif ($tanggal === 'ALL'&& $bulan != 'ALL') {
				$typePosisi = 1;
				$posisi = $tahun.'-'.$bulan;
			}else {
				$typePosisi = 2;
				$posisi = $tahun.'-'.$bulan.'-'.$tanggal;
			}
			$data['typePosisi']=$typePosisi;
			$data['kode']=$jenis;
			$data['posisi']=$posisi;
			$result['data']=$this->laporan->sp_absensi_detail($data);
			ini_set('memory_limit', '512M');
			ini_set('max_execution_time', 6000);

			$this->pdf->setPaper('A4', 'landscape');
			$this->pdf->filename = "Laporan Absensi Detail.pdf";
			$this->pdf->load_view('laporan_pdf_detail', $result);
		}
	}

	public function excel_report_absensidetail()
	{
        $this->form_validation->set_rules('bulan', 'Bulan Awal', 'required');
        $this->form_validation->set_rules('tanggal', 'Bulan Akhir', 'required');
		$this->form_validation->set_rules('jenis', 'Pekerja', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['data'] = false;
			redirect('/report/absensi_detail');
		}else{
			$tahun = $this->input->post('tahun');
			$bulan = $this->input->post('bulan');
			$tanggal = $this->input->post('tanggal');
			$jenis = $this->input->post('jenis');
			if ($bulan === 'ALL') {
				$typePosisi = 3;
				$posisi = $tahun;
			}
			elseif ($tanggal === 'ALL'&& $bulan != 'ALL') {
				$typePosisi = 1;
				$posisi = $tahun.'-'.$bulan;
			}else {
				$typePosisi = 2;
				$posisi = $tahun.'-'.$bulan.'-'.$tanggal;
			}
			$data['typePosisi']=$typePosisi;
			$data['kode']=$jenis;
			$data['posisi']=$posisi;
			$result=$this->laporan->sp_absensi_detail($data);
			// Create new Spreadsheet object
			$spreadsheet = new Spreadsheet();
			// Set document properties
			$spreadsheet->getProperties()->setCreator("")
			->setLastModifiedBy("")
			->setTitle('Office 2016 XLSX Test Document')
			->setSubject('Office 2016 XLSX Test Document')
			->setDescription('Test document for Office 2016 XLSX, generated using PHP classes.')
			->setKeywords('office 2016 openxml php')
			->setCategory('Test result file');

			// Add some data
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A1', 'LAPORAN ABSENSI DETAIL - '.$this->session->userdata['logged_in']['uker'].' - Dibuat Oleh '.$this->session->userdata['logged_in']['id'].' - Printed on '.date("d M Y"))
				->setCellValue('A2', 'NO.')
				->setCellValue('B2', 'POSISI')
				->setCellValue('C2', 'PERNR')
				->setCellValue('D2', 'NAMA')
				->setCellValue('E2', 'Masuk Kerja')
				->setCellValue('F2', 'Masuk Kerja Awal')
				->setCellValue('G2', 'Lokasi Absen Masuk')
				->setCellValue('H2', 'Pulang Kerja')
				->setCellValue('I2', 'Pulang Kerja Awal')
				->setCellValue('J2', 'Lokasi Absen Pulang')
				->setCellValue('K2', 'Keterangan')
				->setCellValue('L2', 'Remark')
				->setCellValue('M2', 'Info')
			;

			// Miscellaneous glyphs, UTF-8
			$i=2;
			$no=1;
			foreach($result as $item) {
				$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A'.$i, $no)
				->setCellValue('B'.$i, $item->TANGGAL)
				->setCellValue('C'.$i, $item->PERNR)
				->setCellValue('D'.$i, $item->NAMA)
				->setCellValue('E'.$i, $item->MASUK_KERJA)
				->setCellValue('F'.$i, $item->MASUK_KERJA_EDC)
				->setCellValue('G'.$i, $item->LOKASI_ABSEN_MASUK)
				->setCellValue('H'.$i, $item->PULANG_KERJA)
				->setCellValue('I'.$i, $item->PULANG_KERJA_EDC)
				->setCellValue('J'.$i, $item->LOKASI_ABSEN_PULANG)
				->setCellValue('K'.$i, $item->KET)
				->setCellValue('L'.$i, $item->REMARK)
				->setCellValue('M'.$i, $item->INFO);
				$i++;
				$no++;
			}

			// Rename worksheet
			$spreadsheet->getActiveSheet()->setTitle('Report Excel '.date('d-m-Y H'));

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$spreadsheet->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Xlsx)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="Report Absensi Detail.xlsx"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
			header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header('Pragma: public'); // HTTP/1.0

			$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save('php://output');
			exit;
		}
	}

	public function csv_report_absensidetail()
	{
        $this->form_validation->set_rules('bulan', 'Bulan Awal', 'required');
        $this->form_validation->set_rules('tanggal', 'Bulan Akhir', 'required');
		$this->form_validation->set_rules('jenis', 'Pekerja', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['data'] = false;
			redirect('/report/absensi_detail');
		}else{
			$tahun = $this->input->post('tahun');
			$bulan = $this->input->post('bulan');
			$tanggal = $this->input->post('tanggal');
			$jenis = $this->input->post('jenis');
			if ($bulan === 'ALL') {
				$typePosisi = 3;
				$posisi = $tahun;
			}
			elseif ($tanggal === 'ALL'&& $bulan != 'ALL') {
				$typePosisi = 1;
				$posisi = $tahun.'-'.$bulan;
			}else {
				$typePosisi = 2;
				$posisi = $tahun.'-'.$bulan.'-'.$tanggal;
			}
			$data['typePosisi']=$typePosisi;
			$data['kode']=$jenis;
			$data['posisi']=$posisi;if ($this->session->userdata['logged_in']['role'] === 'Admin') {
				$data['role']=1;
			}elseif ($this->session->userdata['logged_in']['role'] === 'Div') {
				$data['role']=2;
			}
			$data['orgeh']=$this->session->userdata['logged_in']['uker'];
			$query = $this->db->query("EXEC SP_REPORT_ABSENSI_DETAIL2
			".$data['role'].",".$data['typePosisi'].",'".$data['kode']."'
			,'".$data['orgeh']."','".$data['orgeh']."','".$data['posisi']."'");
			$delimiter = ",";
			$newline = "\r\n";
			$enclosure = '"';
			$writer = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);
			force_download('Report Absensi Detail.csv', $writer);
			exit;
		}
	}

	public function absensi_lembur()
	{
		$data['title']="Report Absensi Lembur";
		$this->load->model('menu');
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
        $this->form_validation->set_rules('bulan', 'Bulan', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['data'] = false;
			$data['postData'] = false;
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $menu);
			$this->load->view('r_laporan absensi lembur', $data);
			$this->load->view('templates/footer');
		}else{
			$data['bulan'] = $this->input->post('bulan');
			$result['postData'] = $this->input->post();
			$result['data']=$this->laporan->sp_absensi_lembur($data);
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar', $menu);
			$this->load->view('r_laporan absensi lembur', $result);
			$this->load->view('templates/footer');
		}
	}

	public function pdf_report_lembur()
	{
        $this->form_validation->set_rules('bulan', 'Bulan', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['data'] = false;
			redirect('/report/absensi_lembur');
		}else{
			$data['bulan'] = $this->input->post('bulan');
			$result['data']=$this->laporan->sp_absensi_lembur($data);

			$this->pdf->setPaper('A4', 'portrait');
			$this->pdf->filename = "Laporan Absensi Lembur.pdf";
			$this->pdf->load_view('laporan_pdf_lembur', $result);
		}
	}

	public function excel_report_lembur()
	{
        $this->form_validation->set_rules('bulan', 'Bulan ', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['data'] = false;
			redirect('/report/absensi_lembur');
		}else{
			$data['bulan'] = $this->input->post('bulan');
			$result=$this->laporan->sp_absensi_lembur($data);
			// Create new Spreadsheet object
			$spreadsheet = new Spreadsheet();
			// Set document properties
			$spreadsheet->getProperties()->setCreator("")
			->setLastModifiedBy("")
			->setTitle('Office 2016 XLSX Test Document')
			->setSubject('Office 2016 XLSX Test Document')
			->setDescription('Test document for Office 2016 XLSX, generated using PHP classes.')
			->setKeywords('office 2016 openxml php')
			->setCategory('Test result file');

			// Add some data
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A1', 'LAPORAN ABSENSI LEMBUR - '.$this->session->userdata['logged_in']['uker'].' - Dibuat Oleh '.$this->session->userdata['logged_in']['id'].' - Printed on '.date("d M Y"))
				->setCellValue('A2', 'NO.')
				->setCellValue('B2', 'Tanggal')
				->setCellValue('C2', 'Personal Number')
				->setCellValue('D2', 'Nama')
				->setCellValue('E2', 'Lembur Masuk')
				->setCellValue('F2', 'Lokasi Absen Masuk')
				->setCellValue('G2', 'Lembur Pulang')
				->setCellValue('H2', 'Lokasi Absen Pulang')
				->setCellValue('I2', 'Created By')
			;

			// Miscellaneous glyphs, UTF-8
			$i=2;
			$no=1;
			foreach($result as $item) {
				$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A'.$i, $no)
				->setCellValue('B'.$i, $item->tanggal)
				->setCellValue('C'.$i, $item->personalnumber)
				->setCellValue('D'.$i, $item->nama)
				->setCellValue('E'.$i, $item->lembur_masuk)
				->setCellValue('F'.$i, $item->lokasi_masuk)
				->setCellValue('G'.$i, $item->lembur_pulang)
				->setCellValue('H'.$i, $item->lokasi_pulang)
				->setCellValue('I'.$i, $item->created_by);
				$i++;
				$no++;
			}

			// Rename worksheet
			$spreadsheet->getActiveSheet()->setTitle('Report Excel '.date('d-m-Y H'));

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$spreadsheet->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Xlsx)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="Report Absensi Lembur.xlsx"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
			header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header('Pragma: public'); // HTTP/1.0

			$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save('php://output');
			exit;
		}
	}

	public function csv_report_lembur()
	{
		$data['title']="Report Absensi Lembur";
		$this->load->model('menu');
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
        $this->form_validation->set_rules('bulan', 'Bulan', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['data'] = false;
			$data['postData'] = false;
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $menu);
			$this->load->view('r_laporan absensi lembur', $data);
			$this->load->view('templates/footer');
		}else{
			$data['bulan'] = $this->input->post('bulan');
			$query = $this->db->query("select * from dummy_lembur where
            tanggal like '%".$data['bulan']."%'");
			$delimiter = ",";
			$newline = "\r\n";
			$enclosure = '"';
			$writer = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);
			force_download('Report Absensi Lembur.csv', $writer);
			exit;
		}
	}

	public function absensi_telah_dimaintain()
	{
		$data['title']="Report Absensi Telah dimaintain";
		$this->load->model('menu');
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
        $this->form_validation->set_rules('bulan', 'Bulan', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis Absen', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['data'] = false;
			$data['postData'] = false;
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $menu);
			$this->load->view('r_laporan absensi yang telah dimaintain', $data);
			$this->load->view('templates/footer');
		}else{
			$data['bulan'] = $this->input->post('bulan');
			$data['jenis'] = $this->input->post('jenis');
			$data['tanggal'] = $this->input->post('tanggal');
			$result['postData'] = $this->input->post();
			$result['data']=$this->laporan->sp_absensi_dimaintain($data);
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $menu);
			$this->load->view('r_laporan absensi yang telah dimaintain', $result);
			$this->load->view('templates/footer');
		}
	}

	public function pdf_report_dimaintain()
	{
        $this->form_validation->set_rules('bulan', 'Bulan', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis Absen', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['data'] = false;
			redirect('/report/absensi_telah_dimaintain');
		}else{
			$data['bulan'] = $this->input->post('bulan');
			$data['jenis'] = $this->input->post('jenis');
			$data['tanggal'] = $this->input->post('tanggal');
			$result['data']=$this->laporan->sp_absensi_dimaintain($data);

			$this->pdf->setPaper('A4', 'landscape');
			$this->pdf->filename = "Laporan Absensi yang Telah Dimaintain .pdf";
			$this->pdf->load_view('laporan_pdf_dimaintain', $result);
		}
	}

	public function excel_report_dimaintain()
	{
        $this->form_validation->set_rules('bulan', 'Bulan', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis Absen', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['data'] = false;
			redirect('/report/absensi_telah_dimaintain');
		}else{
			$data['bulan'] = $this->input->post('bulan');
			$data['jenis'] = $this->input->post('jenis');
			$data['tanggal'] = $this->input->post('tanggal');
			$result=$this->laporan->sp_absensi_dimaintain($data);
			// Create new Spreadsheet object
			$spreadsheet = new Spreadsheet();
			// Set document properties
			$spreadsheet->getProperties()->setCreator("")
			->setLastModifiedBy("")
			->setTitle('Office 2016 XLSX Test Document')
			->setSubject('Office 2016 XLSX Test Document')
			->setDescription('Test document for Office 2016 XLSX, generated using PHP classes.')
			->setKeywords('office 2016 openxml php')
			->setCategory('Test result file');

			// Add some data
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A1', 'LAPORAN ABSENSI TELAH DIMAINTAIN - '.$this->session->userdata['logged_in']['uker'].' - Dibuat Oleh '.$this->session->userdata['logged_in']['id'].' - Printed on '.date("d M Y"))
				->setCellValue('A2', 'NO.')
				->setCellValue('B2', 'Tanggal')
				->setCellValue('C2', 'Personal Number')
				->setCellValue('D2', 'Nama')
				->setCellValue('E2', 'Masuk Kerja')
				->setCellValue('F2', 'Masuk Kerja Awal')
				->setCellValue('G2', 'Lokasi Absen Masuk')
				->setCellValue('H2', 'Pulang Kerja')
				->setCellValue('I2', 'Pulang Kerja Awal')
				->setCellValue('J2', 'Lokasi Absen Pulang')
				->setCellValue('K2', 'Keterangan')
				->setCellValue('L2', 'Remark')
				->setCellValue('M2', 'Info')
			;

			// Miscellaneous glyphs, UTF-8
			$i=2;
			$no=1;
			foreach($result as $item) {
				$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A'.$i, $no)
				->setCellValue('B'.$i, $item->tanggal)
				->setCellValue('C'.$i, $item->personal_number)
				->setCellValue('D'.$i, $item->nama)
				->setCellValue('E'.$i, $item->masuk_kerja)
				->setCellValue('F'.$i, $item->masuk_kerja_awal)
				->setCellValue('G'.$i, $item->lokasi_masuk)
				->setCellValue('H'.$i, $item->pulang_kerja)
				->setCellValue('I'.$i, $item->pulang_kerja_awal)
				->setCellValue('J'.$i, $item->lokasi_pulang)
				->setCellValue('K'.$i, $item->keterangan)
				->setCellValue('L'.$i, $item->remark)
				->setCellValue('M'.$i, $item->info);
				$i++;
				$no++;
			}

			// Rename worksheet
			$spreadsheet->getActiveSheet()->setTitle('Report Excel '.date('d-m-Y H'));

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$spreadsheet->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Xlsx)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="Report Absensi Telah Dimaintain.xlsx"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
			header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header('Pragma: public'); // HTTP/1.0

			$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save('php://output');
			exit;
		}
	}

	public function csv_report_dimaintain()
	{
		$data['title']="Report Absensi Telah dimaintain";
		$this->load->model('menu');
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
        $this->form_validation->set_rules('bulan', 'Bulan', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis Absen', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['data'] = false;
			$data['postData'] = false;
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $menu);
			$this->load->view('r_laporan absensi yang telah dimaintain', $data);
			$this->load->view('templates/footer');
		}else{
			$data['bulan'] = $this->input->post('bulan');
			$data['jenis'] = $this->input->post('jenis');
			$data['tanggal'] = $this->input->post('tanggal');
			if ($data['jenis'] == 'ALL') {
				if ($data['tanggal'] == 'ALL') {
					$query = $this->db->query("select * from dummy_dimaintain where
						tanggal like '%".$data['bulan']."%'");
				}else{
					$query = $this->db->query("select * from dummy_dimaintain where
						tanggal like '%".$data['bulan'].'-'.$data['tanggal']."%'");
				}
			}else{
				if ($data['tanggal'] == 'ALL') {
					$query = $this->db->query("select * from dummy_dimaintain where
						tanggal like '%".$data['bulan']."%' and keterangan = '".$data['jenis']."'");
				}else{
					$query = $this->db->query("select * from dummy_dimaintain where
						tanggal like '%".$data['bulan'].'-'.$data['tanggal']."%' and
						keterangan = '".$data['jenis']."'");
				}
			}
			$delimiter = ",";
			$newline = "\r\n";
			$enclosure = '"';
			$writer = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);
			force_download('Report Absensi Telah Dimaintain.csv', $writer);
			exit;
		}
	}

	public function ketidakhadiran_pegawai()
	{
		$data['title']="Report Absensi Ketidak Hadiran";
		$this->load->model('menu');
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
        $this->form_validation->set_rules('awal', 'Bulan Awal', 'required');
        $this->form_validation->set_rules('akhir', 'Bulan Akhir', 'required');
		$this->form_validation->set_rules('pekerja', 'Pekerja', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['data'] = false;
			$data['postData'] = false;
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $menu);
			$this->load->view('R_Laporan Ketidakhardiran Pegawai', $data);
			$this->load->view('templates/footer');
		}else{
			$awal = $this->input->post('awal');
			$akhir = $this->input->post('akhir');
			$pekerja = $this->input->post('pekerja');
			$result['postData'] = $this->input->post();
			$awalTanggal = substr($awal,5).substr($awal,0,4);
			$akhirTanggal = substr($akhir,5).substr($akhir,0,4);
			$data['jenis']=$pekerja;
			$data['awal']=$awalTanggal;
			$data['akhir']=$akhirTanggal;
			$result['data']=$this->laporan->sp_report_ketidakhadiran($data);
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar', $menu);
			$this->load->view('R_Laporan Ketidakhardiran Pegawai', $result);
			$this->load->view('templates/footer');
		}
	}

	public function pdf_report_ketidakhadiran(){
		$this->form_validation->set_rules('awal', 'Bulan Awal', 'required');
        $this->form_validation->set_rules('akhir', 'Bulan Akhir', 'required');
		$this->form_validation->set_rules('pekerja', 'Pekerja', 'required');
		if ($this->form_validation->run() == FALSE) {
			redirect('/report/ketidakhadiran_pegawai');
		}else{
			$awal = $this->input->post('awal');
			$akhir = $this->input->post('akhir');
			$pekerja = $this->input->post('pekerja');
			$awalTanggal = substr($awal,5).substr($awal,0,4);
			$akhirTanggal = substr($akhir,5).substr($akhir,0,4);
			$data['jenis']=$pekerja;
			$data['awal']=$awalTanggal;
			$data['akhir']=$akhirTanggal;
			$result['data']=$this->laporan->sp_report_ketidakhadiran($data);
			ini_set('memory_limit', '512M');
			ini_set('max_execution_time', 6000);

			$this->pdf->setPaper('A1', 'landscape');
			$this->pdf->filename = "Laporan Ketidakhadiran Pegawai.pdf";
			$this->pdf->load_view('laporan_pdf_ketidakhadiran', $result);
		}
	}

	public function excel_report_ketidakhadiran()
	{
		$this->form_validation->set_rules('awal', 'Bulan Awal', 'required');
        $this->form_validation->set_rules('akhir', 'Bulan Akhir', 'required');
		$this->form_validation->set_rules('pekerja', 'Pekerja', 'required');
		if ($this->form_validation->run() == FALSE) {
			redirect('/report/ketidakhadiran_pegawai');
		}else{
			$awal = $this->input->post('awal');
			$akhir = $this->input->post('akhir');
			$pekerja = $this->input->post('pekerja');
			$awalTanggal = substr($awal,5).substr($awal,0,4);
			$akhirTanggal = substr($akhir,5).substr($akhir,0,4);
			$data['jenis']=$pekerja;
			$data['awal']=$awalTanggal;
			$data['akhir']=$akhirTanggal;
			$result=$this->laporan->sp_report_ketidakhadiran($data);
			// Create new Spreadsheet object
			$spreadsheet = new Spreadsheet();

			// Set document properties
			$spreadsheet->getProperties()->setCreator("")
			->setLastModifiedBy("")
			->setTitle('Office 2016 XLSX Test Document')
			->setSubject('Office 2016 XLSX Test Document')
			->setDescription('Test document for Office 2016 XLSX, generated using PHP classes.')
			->setKeywords('office 2016 openxml php')
			->setCategory('Test result file');

			// Add some data
			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A1', 'LAPORAN KETIDAKHADIRAN PEGAWAI - '.$this->session->userdata['logged_in']['uker'].' - Dibuat Oleh '.$this->session->userdata['logged_in']['id'].' - Printed on '.date("d M Y"))
				->setCellValue('A2', 'No.')
				->setCellValue('B2', 'POSISI')
				->setCellValue('C2', 'PERNR')
				->setCellValue('D2', 'NAMA')
				->setCellValue('E2', 'PERUSAHAAN')
				->setCellValue('F2', 'TIPE')
				->setCellValue('G2', 'BULAN')
				->setCellValue('H2', 'TAHUN')
				->setCellValue('I2', 'ORGEH')
				->setCellValue('J2', 'NAMA_ORGEH')
				->setCellValue('K2', 'ORGEH_INDUK')
				->setCellValue('L2', 'NAMA_ORGEH_INDUK')
				->setCellValue('M2', 'HKJ')
				->setCellValue('N2', 'WEEKEND')
				->setCellValue('O2', 'LIBUR')
				->setCellValue('P2', 'HD')
				->setCellValue('Q2', 'TM')
				->setCellValue('R2', 'CP')
				->setCellValue('S2', 'PC')
				->setCellValue('T2', 'TK')
				->setCellValue('U2', 'ST')
				->setCellValue('V2', 'DL')
				->setCellValue('W2', 'PJ')
				->setCellValue('X2', 'PD')
				->setCellValue('Y2', 'NA')
				->setCellValue('Z2', 'SK')
				->setCellValue('AA2', 'TW')
				->setCellValue('AB2', 'CT')
				->setCellValue('AC2', 'CB')
				->setCellValue('AD2', 'ISS')
				->setCellValue('AE2', 'IM')
				->setCellValue('AF2', 'HDD')
				->setCellValue('AG2', 'PP')
				->setCellValue('AH2', 'LH')
				->setCellValue('AI2', 'MD')
				->setCellValue('AJ2', 'PA')
				->setCellValue('AK2', 'KA')
				->setCellValue('AL2', 'BA')
				->setCellValue('AM2', 'PG')
				->setCellValue('AN2', 'IH')
				->setCellValue('AO2', 'IP')
				->setCellValue('AP2', 'KETERANGAN');

			// Miscellaneous glyphs, UTF-8
			$i=2;
			$no=1;
			foreach($result as $item) {
				$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A'.$i, $no)
				->setCellValue('B'.$i, $item->POSISI)
				->setCellValue('C'.$i, $item->PERNR)
				->setCellValue('D'.$i, $item->NAMA)
				->setCellValue('E'.$i, $item->PERUSAHAAN)
				->setCellValue('F'.$i, $item->TIPE)
				->setCellValue('G'.$i, $item->BULAN)
				->setCellValue('H'.$i, $item->TAHUN)
				->setCellValue('I'.$i, $item->ORGEH)
				->setCellValue('J'.$i, $item->NAMA_ORGEH)
				->setCellValue('K'.$i, $item->ORGEH_INDUK)
				->setCellValue('L'.$i, $item->NAMA_ORGEH_INDUK)
				->setCellValue('M'.$i, $item->HKJ)
				->setCellValue('N'.$i, $item->WEEKEND)
				->setCellValue('O'.$i, $item->LIBUR)
				->setCellValue('P'.$i, $item->HD)
				->setCellValue('Q'.$i, $item->TM)
				->setCellValue('R'.$i, $item->CP)
				->setCellValue('S'.$i, $item->PC)
				->setCellValue('T'.$i, $item->TK)
				->setCellValue('U'.$i, $item->ST)
				->setCellValue('V'.$i, $item->DL)
				->setCellValue('W'.$i, $item->PJ)
				->setCellValue('X'.$i, $item->PD)
				->setCellValue('Y'.$i, $item->NA)
				->setCellValue('Z'.$i, $item->SK)
				->setCellValue('AA'.$i, $item->TW)
				->setCellValue('AB'.$i, $item->CT)
				->setCellValue('AC'.$i, $item->CB)
				->setCellValue('AD'.$i, $item->ISS)
				->setCellValue('AE'.$i, $item->IM)
				->setCellValue('AF'.$i, $item->HDD)
				->setCellValue('AG'.$i, $item->PP)
				->setCellValue('AH'.$i, $item->LH)
				->setCellValue('AI'.$i, $item->MD)
				->setCellValue('AJ'.$i, $item->PA)
				->setCellValue('AK'.$i, $item->KA)
				->setCellValue('AL'.$i, $item->BA)
				->setCellValue('AM'.$i, $item->PG)
				->setCellValue('AN'.$i, $item->IH)
				->setCellValue('AO'.$i, $item->IP)
				->setCellValue('AP'.$i, $item->KETERANGAN);
				$i++;
				$no++;
			}

			// Rename worksheet
			$spreadsheet->getActiveSheet()->setTitle('Report Excel '.date('d-m-Y H'));

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$spreadsheet->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Xlsx)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="Report Ketidakhadiran Pegawai.xlsx"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
			header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header('Pragma: public'); // HTTP/1.0

			$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save('php://output');
			exit;
		}
	}

	public function csv_report_ketidakhadiran()
	{
		$data['title']="Report Absensi Ketidak Hadiran";
		$this->load->model('menu');
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
        $this->form_validation->set_rules('awal', 'Bulan Awal', 'required');
        $this->form_validation->set_rules('akhir', 'Bulan Akhir', 'required');
		$this->form_validation->set_rules('pekerja', 'Pekerja', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['data'] = false;
			$data['postData'] = false;
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $menu);
			$this->load->view('R_Laporan Ketidakhardiran Pegawai', $data);
			$this->load->view('templates/footer');
		}else{
			$awal = $this->input->post('awal');
			$akhir = $this->input->post('akhir');
			$pekerja = $this->input->post('pekerja');
			$awalTanggal = substr($awal,5).substr($awal,0,4);
			$akhirTanggal = substr($akhir,5).substr($akhir,0,4);
			$data['jenis']=$pekerja;
			$data['awal']=$awalTanggal;
			$data['akhir']=$akhirTanggal;
		}
		if ($this->session->userdata['logged_in']['role'] === 'Admin') {
            $data['role']='1';
        }elseif ($this->session->userdata['logged_in']['role'] === 'Div') {
            $data['role']='2';
        }
        $data['orgeh']=$this->session->userdata['logged_in']['uker'];
        $query = $this->db->query("EXEC SP_REPORT_KETIDAKHADIRAN
        '".$data['role']."',".$data['orgeh'].",'".$data['jenis']."'
        ,'".$data['awal']."','".$data['akhir']."'");
		$delimiter = ",";
		$newline = "\r\n";
		$enclosure = '"';
		$writer = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);
		force_download('Report Ketidakhadiran Pegawai.csv', $writer);
		exit;
	}
}
