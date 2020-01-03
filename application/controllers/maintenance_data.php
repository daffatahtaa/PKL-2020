<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class maintenance_data extends CI_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->model('pegawai');
		$this->load->model('menu');
		$this->load->model('hari');
		$this->load->model('shift');


    }

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




	public function tambahPegawai(){
		$this->form_validation->set_rules('pernpegawai','Personal Number','required|min_length[2]');
		$this->form_validation->set_rules('orgeh','Uker','required|is_natural_no_zero');
		
        if ($this->form_validation->run() == FALSE)
        {
			
			$menus = $this->menu->menus();
			$menu = array('menus' => $menus);
			$data['pegawaiku'] = $this->pegawai->tampilkanDataPegawai();
			$data['title']="Data Pegawai";
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$menu);
			$this->load->view('m_pegawai',$data);
			$this->load->view('templates/footer');


        }
        else
        {
			try {
				print "this is our try block n";
				throw new Exception();
			
				print "something went wrong, caught yah! n";
                $this->pegawai->tambahDataPegawai();
               //flash itu nama sessionya , ditambahkan itu isinya
                $this->session->set_flashdata('flash','Ditambahkan');
				redirect ('maintenance_data/lihatPegawai');
			} catch (Exception $e) {
				print "something went wrong, caught yah! n";
			}finally{
				redirect ('maintenance_data/lihatPegawai');
			}

		}
	}
	public function lihatuker(){
		$parameter = $_POST['searchTerm'];
		$data=$this->pegawai->tampilkanDataUkersearch($parameter);
			$rows = array();
			foreach($data as $result){
				$rows[] = array(
					"id"=> $result['ORGEH'], //samadengan value=
					"text"=> $result['ORGEH'].' - '.$result['ORGEH_TX'],
					"value"=> $result['ORGEH_TX']
				);
			}
		echo json_encode($rows);
		exit;
	}
	public function lihatJenisAbsen(){
		$parameter = $_POST['keyword'];
		$data=$this->pegawai->tampilkanParameterAbsensearch($parameter);
			$rows = array();
			foreach($data as $result){
				$rows[] = array(
					"id"=> $result['KODE'].' - '.$result['DESKRIPSI'], //samadengan value=
					"text"=> $result['KODE'].' - '.$result['DESKRIPSI']
					
				);
			}
		echo json_encode($rows);
		exit;
	}	
	


	public function lihatPegawai(){
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$data['pegawaiku'] = $this->pegawai->tampilkanDataPegawai();
		$data['uker']=$this->pegawai->tampilkanDataUker();
		$data['title']="Data Pegawai";
		// $data['kodeuker']=$this->pegawai->tampilkanKodeUker();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$menu);
        $this->load->view('m_pegawai',$data);
        $this->load->view('templates/footer');
	}


	public function lihatDataPegawai(){
		$parameter = $_POST['keyword'];
		$data=$this->pegawai->tampilkanPegawaidanPernr($parameter);
			foreach($data as $result){
				$rows[] = array(
					"id"=> $result['PERNR'],
					"text"=> $result['GABUNGAN_NAME']
				);
			}
		echo json_encode($rows);
		exit;
	}
	public function C_pegawaiLembur()
	{

		$data['lembur']=$this->pegawai->lihatDataLembur();
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$data['title']="Pegawai Lembur";
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$menu);
		$this->load->view('M_Data Lembur',$data);
		$this->load->view('templates/footer');
	}



		public function C_pegawaiTidakMasuk()
	{
		$data['desk']=$this->pegawai->tampilkanParamAbsen();
		$data['tidakmasuk'] = $this->pegawai->pegawaiTidakmasuk();
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$data['title']="Pegawai Tidak Masuk";
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$menu);
		$this->load->view('M_Pegawai Tidak Masuk',$data);
		$this->load->view('templates/footer');
	}

	public function insertDataTidakMasuk(){
		$this->form_validation->set_rules('pegawai','Personal Number','required|min_length[2]');
        $this->form_validation->set_rules('tgl','Tanggal','required');
		$this->form_validation->set_rules('kode','Deskripsi','required|is_natural_no_zero');
		$this->form_validation->set_rules('ket','Keterangan','required');
        if ($this->form_validation->run() == FALSE)
        {
			$data['title']="Pegawai Tidak Masuk";
			$menus = $this->menu->menus();
			$menu = array('menus' => $menus);
			$data['tidakmasuk'] = $this->pegawai->pegawaiTidakmasuk();
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$menu);
			$this->load->view('M_Pegawai Tidak Masuk',$data);
			$this->load->view('templates/footer');


        }
        else
        {
                $this->pegawai->tambahpegawaiTidakMasuk();
               //flash itu nama sessionya , ditambahkan itu isinya
                $this->session->set_flashdata('tidakMasuk','Ditambahkan');
                redirect ('maintenance_data/C_pegawaiTidakMasuk');
		}
	}
	public function hapusTidakMasuk(){
		$this->pegawai->hapusDataTidakMasuk();
		$this->session->set_flashdata('hapusTidakMasukpegawai','Dihapus');
		redirect ('maintenance_data/C_pegawaiTidakMasuk');
	}

	public function insertPegawaiLembur(){

		$this->form_validation->set_rules('pegawai','Pegawai','required');
		$this->form_validation->set_rules('masuk','Jam Masuk','required');
		$this->form_validation->set_rules('pulang','Jam Pulang','required');
		if ($this->form_validation->run() == FALSE)
		{
			$data['title']="Pegawai Lembur";
			$menus = $this->menu->menus();
			$menu = array('menus' => $menus);
			$data['lembur'] = $this->pegawai->lihatDataLembur();
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$menu);
			$this->load->view('M_Data Lembur',$data);
			$this->load->view('templates/footer');


		}
		else
		{
				$this->pegawai->tambahPegawaiLembur();
			//flash itu nama sessionya , ditambahkan itu isinya
				$this->session->set_flashdata('flashLembur','Ditambahkan');
				redirect ('maintenance_data/C_pegawaiLembur');
		}
	}

	public function editPegawai(){
		$this->load->helper('url');
		$this->pegawai->editDataPegawai();
		$this->session->set_flashdata('editpegawai','Diubah');
		redirect ('maintenance_data/lihatPegawai');
	}

	public function hapusPegawai(){
	
		$this->pegawai->hapusDataPegawai();
		$this->session->set_flashdata('hapuspegawai','Dihapus');
		redirect ('maintenance_data/lihatpegawai');


	}

	public function hapusLembur(){
		$this->pegawai->hapusLembur();
		$this->session->set_flashdata('hapusLembur','Dihapus');
		redirect ('maintenance_data/C_pegawaiLembur');
	}



	public function C_pegawaiJadwalKerja()
	{
		$data['title']="Jadwal Kerja";
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$menu);
		$this->load->view('M_Jadwal Kerja');
		$this->load->view('templates/footer');
	}

	public function C_EditJadwalKerja(){
		$this->form_validation->set_rules('jammasuk','Jam Masuk','required');
		$this->form_validation->set_rules('jampulang','Jam Pulang','required');
	
		if ($this->form_validation->run() == FALSE)
		{
			$data['title']="Jadwal Kerja";
			$menus = $this->menu->menus();
			$menu = array('menus' => $menus);
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$menu);
			$this->load->view('M_Jadwal Kerja');
			$this->load->view('templates/footer');


		}
		else
		{
		$this->shift->rubahJadwalKerja();
		$this->session->set_flashdata('editJadwalKerja','Diubah');
		redirect ('maintenance_data/C_pegawaiJadwalKerja');
	}

	}
	public function C_pegawaiJadwalShift()
	{
		$data['title']="Jadwal Shift";
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$data['lihatjadwalshift'] = $this->shift->lihatShift();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$menu);
		$this->load->view('M_Jadwal Shift',$data);
		$this->load->view('templates/footer');
	}

	public function hapusJadwalShift(){
		$this->shift->hapusJadwalShifts();
		$this->session->set_flashdata('hapus Shift','Dihapus');
		redirect ('maintenance_data/C_pegawaiJadwalShift');
	}

	public function EditJadwalShift(){
		$this->form_validation->set_rules('jadwalMasuk','Jam Masuk','required');
		$this->form_validation->set_rules('jadwalPulang','Jam Pulang','required');
	
		if ($this->form_validation->run() == FALSE)
		{
			$data['title']="Jadwal Shift";
			$menus = $this->menu->menus();
			$menu = array('menus' => $menus);
			$data['lihatjadwalshift'] = $this->shift->lihatShift();
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$menu);
			$this->load->view('M_Jadwal Shift',$data);
			$this->load->view('templates/footer');
		}
		else
		{
		$this->shift->editJadwalShift();
		$this->session->set_flashdata('editJadwalShift','Diubah');
		redirect ('maintenance_data/C_pegawaiJadwalShift');
	}
}

	public function C_pegawaiLemburOtomatis()
	{
		$data['title']="Pegawai Lembur Otomatis";
		$data['lemburotomatis'] = $this->pegawai->lihatDataLemburOtomatis();
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$menu);
		$this->load->view('M_Data Lembur Otomatis',$data);
		$this->load->view('templates/footer');
	}

	public function C_TambahPegawaiLemburOtomatis(){
		$this->form_validation->set_rules('pernpegawai','Pegawai','required');
		if ($this->form_validation->run() == FALSE)
		{
			$data['title']="Pegawai Lembur Otomatis";
			$menus = $this->menu->menus();
			$menu = array('menus' => $menus);
			$data['lemburotomatis'] = $this->pegawai->lihatDataLemburOtomatis();
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$menu);
			$this->load->view('M_Data Lembur Otomatis',$data);
			$this->load->view('templates/footer');


		}
		else
		{
				$this->pegawai->tambahPegawaiLemburOtomatis();
			//flash itu nama sessionya , ditambahkan itu isinya
				$this->session->set_flashdata('flash','Ditambahkan');
				redirect ('maintenance_data/C_pegawaiLemburOtomatis');
		}
	}

	public function C_HapusPegawaiLemburOtomatis(){
		$this->pegawai->HapusPegawaiLemburOtomatis();
		$this->session->set_flashdata('hapuspegawaiLembur','Dihapus');
		redirect ('maintenance_data/C_pegawaiLemburOtomatis');
	}		



	public function C_pegawaiOutsource()
	{
		$data['title']="Pegawai Outsource";
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$menu);
		$this->load->view('M_Data Outsource');
		$this->load->view('templates/footer');
	}

	public function C_hariLibur()
	{
		$data['harilibur']=$this->hari->lihatHariLibur();
		$data['title']="Daftar Hari Libur";
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$menu);
		$this->load->view('M_Hari Libur',$data);
		$this->load->view('templates/footer');
	}

	public function tambahHariLibur(){
		$this->form_validation->set_rules('tgl','Tanggal Libur','required');
		$this->form_validation->set_rules('jenlibur','Jenis Libur','required');
		$this->form_validation->set_rules('ket','Keterangan Libur','required');
		if ($this->form_validation->run() == FALSE)
		{
			$data['title']="Daftar Hari Libur";
		$data['harilibur']=$this->hari->lihatHariLibur();
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$menu);
		$this->load->view('M_Hari Libur',$data);
		$this->load->view('templates/footer');



		}
		else
		{
				$this->hari->tambahHariLibur();
			//flash itu nama sessionya , ditambahkan itu isinya
				$this->session->set_flashdata('harilibur','Ditambahkan');
				redirect ('maintenance_data/C_hariLibur');
		}
	}

	public function hapusHariLibur(){
		$this->hari->hapusHariLibur();
		$this->session->set_flashdata('hapusLembur','dihapus');
		redirect ('maintenance_data/C_hariLibur');
	}

	public function c_tambahkanLembur()
	{
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar',$menu);
		$this->load->view('M_Data Lembur_Tambahkan Data Lembur');
		$this->load->view('templates/footer');
	}

	public function c_tambahkanHariLibur()
	{
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar',$menu);
		$this->load->view('M_Hari Libur_Tambahkan Hari Libur');
		$this->load->view('templates/footer');
	}

	public function c_tambahkanUser()
	{
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar',$menu);
		$this->load->view('M_Pengelolaan User_Tambahkan User');
		$this->load->view('templates/footer');
	}
	public function lihatPegawaiOutsource(){
		$parameter = $_POST['keyword'];
		$data=$this->pegawai->tampilkanPegawaiOutsource($parameter);
			foreach($data as $result){
				$rows[] = array(
					"id"=> $result['PERNR'],
					"text"=> $result['GABUNGAN_NAME']
				);
			}
		echo json_encode($rows);
		exit;
	}


	public function insertPegawaiOutsource(){
		$this->form_validation->set_rules('pernpegawai','Personal Number','required|is_natural_no_zero');
        $this->form_validation->set_rules('orgeh','Uker','required|is_natural_no_zero');
        if ($this->form_validation->run() == FALSE)
        {
			
			$data['title']="Pegawai Outsource";
			$menus = $this->menu->menus();
			$menu = array('menus' => $menus);
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar',$menu);
			$this->load->view('M_Data Outsource');
			$this->load->view('templates/footer');


        }
        else
        {
                $this->pegawai->tambahDataPegawaiOutsource();
               //flash itu nama sessionya , ditambahkan itu isinya
                $this->session->set_flashdata('flash','Ditambahkan');
                redirect ('maintenance_data/lihatPegawai');
		}
	}

	public function C_data_absensi(){
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$data['title']="Patching Data Pegawai";
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$menu);
        $this->load->view('m_data_absensi',$data);
        $this->load->view('templates/footer');
	}

	public function data_absensi(){
		$data['title']="Patching Data Pegawai";
		$this->load->model('menu');
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$this->form_validation->set_rules('bulan', 'Bulan', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('jenis', 'Jenis', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['postData'] = $this->input->post();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $menu);
			$this->load->view('m_data_absensi', $data);
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
			elseif ($tanggal === 'ALL') {
				$typePosisi = 1;
				$posisi =$bulan;
			}else {
				$typePosisi = 2;
				$posisi = $tahun.'-'.$bulan.'-'.$tanggal;
			}
			$data['typePosisi']=$typePosisi;
			$data['kode']=substr($jenis,0,3);
			$data['posisi']=$posisi;
			$result['data']=$this->pegawai->lihatDataAbsen($data);
			$result['postData'] = $this->input->post();
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar', $menu);
			$this->load->view('m_data_absensi', $result);
			$this->load->view('templates/footer');
		}
	}

	public function editDataAbsensi(){
		$data['title']="Patching Data Pegawai";
		$this->load->model('menu');
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$this->form_validation->set_rules('jamMasuk', 'Jam Masuk', 'required');
		$this->form_validation->set_rules('jamPulang', 'Jam Pulang', 'required');
		$this->form_validation->set_rules('kode', 'Koreksi', 'required');
		$this->form_validation->set_rules('ket', 'Keterangan', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['postData'] = $this->input->post();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $menu);
			$this->load->view('m_data_absensi', $data);
			$this->load->view('templates/footer');
		}else{
			$this->pegawai->editDataAbsensi();
			$data['postData'] = $this->input->post();
			$this->session->set_flashdata('edits','Diubah');
			redirect ('maintenance_data/data_absensi');
		}





	}
}
