<?php

 //we need to start session in order to access it through CI

Class User_Authentication extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load form helper library
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load database
        $this->load->model('tuser');
        $this->load->model('menu');

        // Load session library
        $this->load->library('session');

        // Load the captcha helper
        $this->load->helper('captcha');
    }

    // Show login page
    public function index() {
        if (isset($this->session->userdata['logged_in'])) {
            # code...
            $role = $this->session->userdata['logged_in']['role'];
            if ($role == 'sti') {
                redirect('/manage_user/m_pengelolaan_user');
            } else if ($role == 'Admin'){
                redirect('/home');
            } else if ($role == 'Div'){
                redirect('/home');
            }
        }else{
            // Captcha configuration
            $config = array(
                'img_path'      => 'captcha_images/',
                'img_url'       => base_url().'captcha_images/',
                'img_width'     => '120',
                'img_height'    => 35,
                'word_length'   => 6,
                'pool'          => '0123456789abcdefghijklmnopqrstuvwxyz',
                'font_size'     => 20
            );
            $captcha = create_captcha($config);

            // Unset previous captcha and set new captcha word
            $this->session->unset_userdata('captchaCode');
            $this->session->set_userdata('captchaCode', $captcha['word']);

            // Pass captcha image to view
            $data['captchaImg'] = $captcha['image'];
            $data['title']="Portal Absen BRI";
            $this->load->view('templates/header',$data);
            $this->load->view('login_form', $data);
        }
    }

    // Show registration page
    public function user_registration_show() {
		$menus = $this->menu->menus();
        $data = array('menus' => $menus);
        $data['title']="Tambah User";
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar', $data);
        $this->load->view('registration_form');
        $this->load->view('templates/footer');
    }

    // Validate and store registration data in database
    public function new_user_registration() {

        // Check validation for user input in SignUp form
        $this->form_validation->set_rules('id', 'Username', 'trim|required|min_length[5]|max_length[16]|is_unique[tuser.Id]');
        $this->form_validation->set_rules('passwd', 'Password', 'trim|required|min_length[8]|max_length[16]');
        $this->form_validation->set_rules('role', 'Role', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('uker', 'Uker', 'trim|required|max_length[100]');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            echo "<script>
            window.location.href='user_registration_show';
            </script>";
        } else {
            $uker=$this->tuser->find_uker($this->input->post('uker'));
            foreach($uker as $result){
                $ket_uker = $result['ORGEH_TX'];
            }
            $data = array(
                'id' => $this->input->post('id'),
                'passwd' => md5($this->input->post('passwd')),
                'role' => $this->input->post('role'),
                'uker' => $this->input->post('uker'),
                'ket_uker' => $ket_uker
            );
            $result = $this->tuser->registration_insert($data);
            if ($result == TRUE) {
                $data['message_display'] = 'Berhasil menambah pengguna !';
                redirect('/manage_user/m_pengelolaan_user');
            } else {

            }
        }
    }

    // Check for user login process
    public function user_login_process() {

        $this->form_validation->set_rules('id', 'Username', 'required');
        $this->form_validation->set_rules('passwd', 'Password', 'required');
        $inputCaptcha = $this->input->post('captcha');
        $sessCaptcha = $this->session->userdata('captchaCode');
        if($inputCaptcha === $sessCaptcha){
            if ($this->form_validation->run() == FALSE) {
                if(isset($this->session->userdata['logged_in'])){
                    $role = $this->session->userdata['logged_in']['role'];
                    if ($role == 'sti') {
                        redirect('/manage_user/m_pengelolaan_user');
                    } else{
                        redirect('/home');
                    }
                }else{
                    $this->session->set_flashdata('errors', validation_errors());
                    redirect('/user_authentication');
                }
            } else {
                $data = array(
                    'Id' => $this->input->post('id'),
                    'passwd' => md5($this->input->post('passwd'))
                );
                $result = $this->tuser->login($data);
                if ($result == TRUE) {

                    $username = $this->input->post('id');
                    $result = $this->tuser->read_user_information($username);
                    if ($result != false) {
                        $session_data = array(
                            'id' => $result[0]->Id,
                            'role' => $result[0]->role,
                            'uker' => $result[0]->uker,
                        );
                        // Add user data in session
                        $this->session->set_userdata('logged_in', $session_data);
                        $role = $this->session->userdata['logged_in']['role'];
                        if ($role == 'sti') {
                            redirect('/manage_user/m_pengelolaan_user');
                        } else{
                            redirect('/home');
                        }
                    }
                } else {
                    $this->session->set_flashdata('errors', 'username atau password salah');
                    redirect('/user_authentication');
                }
            }
        }else{
            $this->session->set_flashdata('errors', 'captcha salah');
            redirect('/user_authentication');
        }
    }

    // Logout from admin page
    public function logout() {

        // Removing session data
        $sess_array = array(
            'id' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $this->session->set_flashdata('logout','Berhasil');
        redirect('/user_authentication');
    }

    public function edit($id)
    {
       $item = $this->tuser->find_item($id);
       $menus = $this->menu->menus();
       $menu = array('menus' => $menus);
       $this->load->view('templates/header');
       $this->load->view('templates/sidebar', $menu);
       $this->load->view('edit_user_form',array('item'=>$item));
       $this->load->view('templates/footer');
    }

    public function update($id)
    {
        $this->form_validation->set_rules('role', 'Role', 'max_length[10]');
        $this->form_validation->set_rules('uker', 'Uker', 'max_length[100]');
        $uker=$this->tuser->find_uker($this->input->post('uker'));
        foreach($uker as $result){
            $ket_uker = $result['ORGEH_TX'];
        }


        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('errors', validation_errors());
            redirect(base_url('user_authentication/edit/'.$id));
        }else{
          $this->tuser->update_item($id, $ket_uker);
          $this->session->set_flashdata('success', 'user berhasil di update');
          redirect(base_url('user_authentication/edit/'.$id));
        }
    }

    public function delete($id)
    {
       $item = $this->tuser->delete_item($id);
       redirect(base_url('user_authentication'));
    }

    public function reset($id)
    {
        $item = $this->tuser->reset_password($id);
        redirect(base_url('user_authentication'));
    }

}

?>
