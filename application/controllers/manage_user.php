<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class manage_user extends CI_Controller {

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

		// Load form validation library
		$this->load->library('form_validation');

		// Load database
		 $this->load->database();
		$this->load->model('tuser');
    }

	public function m_pengelolaan_user()
	{
		$result['data']=$this->tuser->select_data();
		$this->load->model('menu');
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$data['title']="Manage User";
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar', $menu);
		$this->load->view('m_pengelolaan user', $result);
		$this->load->view('templates/footer');
	}

	public function u_manage_user()
	{
		;
		$this->load->model('menu');
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$data['title']="Ubah Password";
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $menu);
		$this->load->view('u_manage user');
		$this->load->view('templates/footer');
	}

	public function ganti_password($id)
    {
		$this->form_validation->set_rules('passwd', 'Password', 'required|min_length[8]|max_length[16]');
		$this->form_validation->set_rules('passwdconf', 'Password Confirmation', 'required|matches[passwd]|min_length[8]|max_length[16]');


        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('errors', validation_errors());
            redirect(base_url('manage_user/u_manage_user'));
        }else{
          $this->tuser->update_password($id);
		  $this->session->set_flashdata('success', 'password berhasil diubah');
          redirect(base_url('manage_user/u_manage_user'));
        }
    }


}
