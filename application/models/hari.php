<?php 
Class hari extends CI_Model{

    public function lihatHariLibur(){
        $query=$this->db->query("SELECT POSISI,KETERANGAN,JENIS FROM ABSENSI_HARI_LIBUR WHERE JENIS = 1 OR JENIS = 2");
        return $query->result_array();
    }

    public function tambahHariLibur(){
        $this->load->helper('date');
        date_default_timezone_set("Asia/Jakarta");
        $time = time();
        $tgl = date('Y-m-d G:i:s',$time);
          //$newtgl = date('d F Y'); //8 juli 2019
              // $newDate = date("dmY", $time);

             $inputtgl =$this->input->post('tgl',true);
             $jenislibur = $this->input->post('jenlibur',true);
             $ket = $this->input->post('ket',true);
             $pembuat=  $this->session->userdata['logged_in']['id'];
          $data=[ 
              "POSISI"=>$inputtgl,
              "KET"=>$ket,
              "JENIS"=>$jenislibur,
              "KETERANGAN"=>$ket,
              "CREATE_DATE"=>$tgl,
              "CREATE_BY"=>$pembuat,
          ];
  
          $this->db->insert('ABSENSI_HARI_LIBUR',$data);
    }

    public function hapusHariLibur(){
        $id=$this->input->post('posisiLama');
        $this->db->where('POSISI', $id);
        $this->db->delete('ABSENSI_HARI_LIBUR');
    }
}
?>