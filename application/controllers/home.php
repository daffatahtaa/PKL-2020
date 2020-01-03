<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

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

        $this->load->model('menu');
		$this->load->database();
	   $this->load->model('tuser');
	   $this->load->model('laporan');
		
	}
	public function index()
	{
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$data['title']="Portal Absen BRI";
		$this->form_validation->set_rules('bulan', 'Bulan Awal', 'required');
        $this->form_validation->set_rules('tahun', 'Bulan Akhir', 'required');
		if ($this->form_validation->run() == FALSE) {
			$jenis = 'NAMA';
			$typePosisi = 1;
			$posisi = date('Y-m');
			$data['typePosisi']=$typePosisi;
			$data['kode']=$jenis;
			$data['posisi']=$posisi;
			$data['pernr']='default';
			$data['ket']='default';
			$data['postData'] = $data;
			$result['data']=$this->laporan->sp_bi($data);
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar', $menu);
			$this->load->view('home', $result);
			$this->load->view('templates/footer');
		}else{
			$tahun = $this->input->post('tahun');
			$bulan = $this->input->post('bulan');
			$jenis = 'NAMA';
			$typePosisi = 1;
			$posisi = $tahun.'-'.$bulan;
			$data['typePosisi']=$typePosisi;
			$data['kode']=$jenis;
			$data['posisi']=$posisi;
			$data['pernr']='default';
			$data['ket']='default';
			$result['data']=$this->laporan->sp_bi($data);
			$result['postData'] = $data;
			
			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar', $menu);
			$this->load->view('home', $result);
			$this->load->view('templates/footer');
		}
	}

	public function m_pegawai()
	{
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $menu);
		$this->load->view('m_pegawai');
		$this->load->view('templates/footer');
	}

}
