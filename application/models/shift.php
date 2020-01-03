<?php
class shift extends CI_Model{

    public function lihatShift(){
        $uker = $this->session->userdata['logged_in']['uker'];
        $query=$this->db->query("SELECT *  FROM ABSENSI_JADWAL_SHIFT where ORGEH = '$uker'");
        $shift = $query->result_array();
        foreach($shift as $hasil){
            $shift1 = $hasil['ORGEH'];
        }

        if(isset($shift1)){
                return $shift;

        }else{
            return $shift = null;
        }
    }

    public function rubahJadwalKerja(){
        $timezone = $this->input->post('timezone',true);
        $jammasuk = $this->input->post('jammasuk',true);
        $jammkeluar = $this->input->post('jampulang',true);

        $this->load->helper('date');
        date_default_timezone_set("Asia/Jakarta");
        $time = time();
        $updateat =  date('Y-m-d G:i:s',$time);

        $uker = $this->session->userdata['logged_in']['uker'];
        $query=$this->db->query("SELECT *  FROM ABSENSI_JADWAL_SHIFT where ORGEH = '$uker'");
        $shift = $query->result_array();
        foreach($shift as $hasil){
            $shift1 = $hasil['ORGEH'];
        }

        if(isset($shift1)){
            $data=[
                "TIMEZONE"=>$timezone,
                "JADWAL_KERJA_MASUK"=>$jammasuk,
                "JADWAL_KERJA_PULANG"=>$jammkeluar,
                "UPDATE_DATE"=> $updateat
            ];
            $this->db->where('ORGEH', $uker);
            $this->db->update('ABSENSI_JADWAL_SHIFT', $data);

        }else{
            return $shift = null;
        }





    }
        public function hapusJadwalShifts(){
            $shift = $this->input->post('shift',true);
            $uker =  $this->session->userdata['logged_in']['uker'];
            if($shift == 1){
                $data = array(
                    'JADWAL_SHIFT1_MASUK' => NULL,
                    'JADWAL_SHIFT1_PULANG'  => NULL,
            );
            $this->db->where('ORGEH', $uker);
            $this->db->update('ABSENSI_JADWAL_SHIFT', $data);
        
            }elseif($shift == 2){
                $data = array(
                    'JADWAL_SHIFT2_MASUK' => NULL,
                    'JADWAL_SHIFT2_PULANG'  => NULL,
            );
            $this->db->where('ORGEH', $uker);
            $this->db->update('ABSENSI_JADWAL_SHIFT', $data);
            }elseif($shift == 3){
            $tables = array('JADWAL_SHIFT3_MASUK', 'JADWAL_SHIFT3_PULANG');
            $data = array(
                'JADWAL_SHIFT3_MASUK' => NULL,
                'JADWAL_SHIFT3_PULANG'  => NULL,
             );
             $this->db->where('ORGEH', $uker);
            $this->db->update('ABSENSI_JADWAL_SHIFT', $data);
            }
        }

        public function editJadwalShift(){
            $shift = $this->input->post('shift',true);
            $jadwalMasuk = $this->input->post('jadwalMasuk',true);
            $jadwalPulang = $this->input->post('jadwalPulang',true);
            $uker =  $this->session->userdata['logged_in']['uker'];
            if($shift == 1){
                
                $data = array(
                    'JADWAL_SHIFT1_MASUK' => $jadwalMasuk,
                    'JADWAL_SHIFT1_PULANG'  => $jadwalPulang,
            );
            $this->db->where('ORGEH', $uker);
            $this->db->update('ABSENSI_JADWAL_SHIFT', $data);
        
            }elseif($shift == 2){
                $data = array(
                    'JADWAL_SHIFT2_MASUK' => $jadwalMasuk,
                    'JADWAL_SHIFT2_PULANG'  => $jadwalPulang,
            );
            $this->db->where('ORGEH', $uker);
            $this->db->update('ABSENSI_JADWAL_SHIFT', $data);
            }elseif($shift == 3){
            $tables = array('JADWAL_SHIFT3_MASUK', 'JADWAL_SHIFT3_PULANG');
            $data = array(
                'JADWAL_SHIFT3_MASUK' => $jadwalMasuk,
                'JADWAL_SHIFT3_PULANG'  => $jadwalPulang,
             );
             $this->db->where('ORGEH', $uker);
            $this->db->update('ABSENSI_JADWAL_SHIFT', $data);
            }
        }
    
 }
?>
