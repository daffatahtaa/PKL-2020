<?php
Class pegawai extends CI_Model {

    public function tambahDataPegawai(){
       $pernr= $this->input->post('pernpegawai',true);
       $orgeh = $this->input->post('orgeh',true);
       $pembuat=  $this->session->userdata['logged_in']['id'];
        $this->load->helper('date');

        date_default_timezone_set("Asia/Jakarta");
        $time = time();
        $tgl = date('Y-m-d',$time);
    
        $result=$this->db->query("select PERNR from PARAM_UKER_DEFINIT where PERNR = '$pernr' ");
        $hasil = $result->result_array();
        foreach($hasil as $orgehs){
            $pernrdefinit=$orgehs['PERNR'];
        }
        if(isset($pernrdefinit)){
            $this->db->query("DELETE FROM PARAM_UKER_DEFINIT WHERE PERNR = $pernr ");
        }
        $datauker = $this->db->query("with data as (
            select distinct a.BRANCH as ORGEH, b.BRDESC as ORGEH_TX from organisasi a with(nolock)
            inner join dwh_branch b  with(nolock) on convert(int,a.branch) = convert(int,b.BRANCH)
            union
            select distinct a.ORGEH, a.ORGEH_TX from organisasi a  with(nolock)
            left join dwh_branch b  with(nolock) on convert(int,a.branch) = convert(int,b.BRANCH)
            )
            select * from data WHERE ORGEH ='$orgeh'" );
   
        $hasil2 = $datauker->result_array();
        foreach($hasil2 as $result){
             $orgehdefinit=$result['ORGEH'];
               $namauker = $result['ORGEH_TX'];
               
           }

        $data=[ 
            "PERNR"=>$pernr,
            "ORGEH"=>$orgehdefinit,
            "UKER"=>$namauker,
            "CREATE_DATE"=>$tgl,
            "CREATE_BY"=>$pembuat
        ];

        $this->db->insert('PARAM_UKER_DEFINIT',$data);

    }

    public function tampilkanDataPegawai(){
     

        $query=$this->db->query("select P.PERNR,P.ORGEH,P.UKER, D.SNAME,P.CREATE_DATE from PARAM_UKER_DEFINIT P 
                                JOIN data_pekerja D ON P.PERNR=D.PERNR 
                                UNION
                                select P.PERNR,P.ORGEH,P.UKER,O.Nama,P.CREATE_DATE from PARAM_UKER_DEFINIT P 
                                JOIN PEGAWAI_OUTSOURCE O ON P.PERNR = O.PERNR");
        return $query->result_array();
        //return $this->db->get('BRIHC_PA0001')->result_array();
        // $query = $this->db->query("SELECT PERNRN,SNAME,ORGEH,CREATE_DATE FROM BRIHC_PA0001");
        //     return $query->result_array();
    }
   


    // public function editDataPegawai(){
    //     $PERNR = $this->input->post('pernpegawai',true);
    //     $ukerbaru = $this->input->post('uker',true);
    //     $result=$this->db->query("SELECT o.ORGEH, o.ORGEH_TX, b.MBDESC
    //                                 FROM organisasi o, dwh_branch b
    //                                 where ORGEH = $ukerbaru");
    //     $hasil = $result->result_array();
    //     foreach($hasil as $orgehs){
    //         $orgeh=$orgehs['ORGEH'];
    //         $orgeh_tx=$orgehs['ORGEH_TX'];
    //     }

    //     $data=[ 
    //         "ORGEH"=>$orgeh,
    //         "ORGEH_TX"=>$orgeh_tx,
    //     ];
    //     $this->db->where('PERNR', $PERNR);
    //     $this->db->update('data_pekerja', $data);
    // }
    public function hapusDataPegawai(){
        $id=$this->input->post('PERNRlama');
        $this->db->where('PERNR', $id);
        $this->db->delete('PARAM_UKER_DEFINIT');

        
    }

    public function tampilkanDataUker(){
        $query=$this->db->query("select ORGEH_TX from organisasi");
        return $query->result_array();
    }
    public function tampilkanDataUkersearch($parameter){
        $query = $this->db->query("with data as (
            select distinct a.BRANCH as ORGEH, b.BRDESC as ORGEH_TX from organisasi a with(nolock)
            inner join dwh_branch b  with(nolock) on convert(int,a.branch) = convert(int,b.BRANCH)
            union
            select distinct a.ORGEH, a.ORGEH_TX from organisasi a  with(nolock)
            left join dwh_branch b  with(nolock) on convert(int,a.branch) = convert(int,b.BRANCH)
            )
            select * from data
            where ORGEH like '%$parameter%' or ORGEH_TX like '%$parameter%'");
        return $query->result_array();
    }

    public function pegawaiTidakMasuk(){
        $query = $this->db->query("SELECT PERNR,NAMA,TANGGAL,KODE,DESKRIPSI,KETERANGAN FROM T_TIDAK_MASUK");
        return $query->result_array();
    }

    public function tampilkanParamAbsen(){
        
        // $query = $this->db->query("SELECT CONCAT(KODE, CONCAT('- ',DESKRIPSI)) AS GABUNGAN FROM PARAM_ABSENSI");
        $query = $this->db->query("SELECT KODE , DESKRIPSI  FROM PARAM_ABSENSI");
        return $query->result_array();
    }
    public function tampilkanParameterAbsen($param){
        
        // $query = $this->db->query("SELECT CONCAT(KODE, CONCAT('- ',DESKRIPSI)) AS GABUNGAN FROM PARAM_ABSENSI");
        $query = $this->db->query("SELECT KODE , DESKRIPSI  FROM PARAM_ABSENSI  WHERE KODE LIKE '%$param%' OR DESKRIPSI LIKE '%$param%' ");
        return $query->result_array();
    }


    public function tampilkanPegawaidanPernr($params){
        // $query = $this->db->query(" SELECT PERNR, SNAME, CONCAT(PERNR, CONCAT('- ',SNAME)) AS 
        //         GABUNGAN_NAME FROM data_pekerja 
        //         WHERE PERNR LIKE '%$params%' OR SNAME LIKE '%$params%' ");
        $query = $this->db->query(" SELECT PERNR, SNAME, CONCAT(PERNR, CONCAT('- ',SNAME)) AS 
                 GABUNGAN_NAME FROM data_pekerja 
                WHERE PERNR LIKE '%$params%' OR SNAME LIKE '%$params%' ");
        return $query->result_array();

    }
    public function tambahpegawaiTidakMasuk(){
        $this->load->helper('date');
        $datestring =  '%Y%m%d';
         $time = time();
         $tgl = mdate($datestring, $time);
        //$newtgl = date('d F Y'); //8 juli 2019
            // $newDate = date("dmY", $time);
        $pernr =$this->input->post('pegawai',true);
        $query2 = $this->db->query("SELECT SNAME , ORGEH FROM data_pekerja WHERE PERNR='$pernr' ");
        $sname = $query2->result_array();
        foreach($sname as $hasilsname){
            $nama['coba']=$hasilsname['SNAME'];
            $orgeh = $hasilsname['ORGEH'];
        }
        $kode = $this->input->post('kode',true);
        $query3 = $this->db->query("SELECT deskripsi FROM param_absensi WHERE kode ='$kode'");
        $deskripsi = $query3->result_array();
        foreach($deskripsi as $hasildeskripsi){
            $desc = $hasildeskripsi['deskripsi'];
        }
       $pembuat=  $this->session->userdata['logged_in']['id'];
        $data=[ 
            "PERNR"=>$pernr,
            "NAMA"=>$nama['coba'],
            "TANGGAL"=>$tgl,
            "ORGEH"=>$orgeh,
            "KODE"=>$kode,
            "DESKRIPSI"=>$desc,
            "KETERANGAN"=>$this->input->post('ket'),
            "CREATE_DATE"=>$tgl,
            "CREATE_BY"=>$pembuat
        ];

        $this->db->insert('T_TIDAK_MASUK',$data);
    }

    public function tambahPegawaiLembur(){
        $this->load->helper('date');
        date_default_timezone_set("Asia/Jakarta");
        $time = time();
        $tgl = date('Y-m-d G:i:s',$time);
        //$date = new DateTime($time, new DateTimeZone('Asia/Jakarta'));
        //$tgl = $date->format('Y-m-d H:i:s');    

       // $tglInput = new DateTime(,true), new DateTimeZone('Asia/Jakarta'));
        //$newtgl = date('d F Y'); //8 juli 2019
         // $newDate = date("dmY", $time);
        $pernr =$this->input->post('pegawai',true);
    

        $query2 = $this->db->query("SELECT SNAME , ORGEH  ,ORGEH_TX FROM data_pekerja WHERE PERNR='$pernr' ");
        $sname = $query2->result_array();
        foreach($sname as $hasilsname){
            $nama['coba']=$hasilsname['SNAME'];
            $orgeh = $hasilsname['ORGEH'];
            $orgeh_tx = $hasilsname['ORGEH_TX'];
                }
        $kode = $this->input->post('kode',true);
        $query3 = $this->db->query("SELECT deskripsi FROM param_absensi WHERE kode ='$kode'");
        $deskripsi = $query3->result_array();
        foreach($deskripsi as $hasildeskripsi){
            $desc = $hasildeskripsi['deskripsi'];
        }
       $pembuat=  $this->session->userdata['logged_in']['id'];
       
        $data=[ 
            "PERNR"=>$pernr,
            "NAMA"=>$nama['coba'],
            "ORGEH"=>$orgeh,
            "UKER"=>$orgeh_tx,            
            "LEMBUR_MASUK"=>$this->input->post('masuk'),
            "LEMBUR_PULANG"=>$this->input->post('pulang'),
            "CREATE_DATE"=>$tgl,
            "CREATE_BY"=>$pembuat
        ];

        $this->db->insert('ABSENSI_LEMBUR',$data);
    }

    public function hapusDataTidakMasuk(){
        $id=$this->input->post('PERNRlama');
        $this->db->where('PERNR', $id);
        $this->db->delete('T_TIDAK_MASUK');
    }

    public function lihatDataLembur(){
        $query=$this->db->query("SELECT CREATE_DATE,PERNR,NAMA,LEMBUR_MASUK,LEMBUR_PULANG FROM ABSENSI_LEMBUR ");
        return $query->result_array();
    }

    public function hapusLembur(){
        $id= $this->input->post('PERNRlama');
        $tgl= $this->input->post('tgllama');
        $this->db->where('PERNR', $id);
        $this->db->where('CREATE_DATE', $tgl);
        $this->db->delete('ABSENSI_LEMBUR');
    }

    public function tambahPegawaiLemburOtomatis(){
        date_default_timezone_set("Asia/Jakarta");
        $time = time();
        $tgl = date('Y-m-d',$time);
        $pernr= $this->input->post('pernpegawai',true);
        $pembuat=  $this->session->userdata['logged_in']['id'];
        $query=$this->db->query("select SNAME FROM data_pekerja WHERE PERNR='$pernr'");
        $pegawe = $query->result_array();
        var_dump($pegawe);
        foreach($pegawe as $result){
            $nama = $result['SNAME'];
        }

        $data=[ 
            "PERNR"=>$pernr,
            "NAMA"=>$nama,
            "CREATE_DATE"=>$tgl,
            "CREATE_BY"=>$pembuat
        ];

        $this->db->insert('T_LEMBUR_OTOMATIS',$data);
    }

    public function lihatDataLemburOtomatis(){
        $query=$this->db->query("SELECT * FROM T_LEMBUR_OTOMATIS");
        return $query->result_array();
    }

    public function HapusPegawaiLemburOtomatis(){
        $id= $this->input->post('PERNRlama');
        $tgl= $this->input->post('tgllama');
        $this->db->where('PERNR', $id);
        $this->db->where('CREATE_DATE', $tgl);
        $this->db->delete('T_LEMBUR_OTOMATIS');
    }
    public function tampilkanPegawaiOutsource(){
        $query=$this->db->query("SELECT PERNR, CONCAT(PERNR, CONCAT('- ',Nama)) AS 
        GABUNGAN_NAME FROM PEGAWAI_OUTSOURCE ");
        return $query->result_array();
    }


    public function tambahDataPegawaiOutsource(){
        $pernr= $this->input->post('pernpegawai',true);
        $orgeh = $this->input->post('orgeh',true);
        $pembuat=  $this->session->userdata['logged_in']['id'];
         $this->load->helper('date');
 
         date_default_timezone_set("Asia/Jakarta");
         $time = time();
         $tgl = date('Y-m-d',$time);
     
         $result=$this->db->query("select PERNR from PARAM_UKER_DEFINIT where PERNR = '$pernr' ");
         $hasil = $result->result_array();
         foreach($hasil as $orgehs){
             $pernrdefinit=$orgehs['PERNR'];
         }
         if(isset($pernrdefinit)){
             $this->db->query("DELETE FROM PARAM_UKER_DEFINIT WHERE PERNR = $pernr ");
         }
         $datauker = $this->db->query("with data as (
             select distinct a.BRANCH as ORGEH, b.BRDESC as ORGEH_TX from organisasi a with(nolock)
             inner join dwh_branch b  with(nolock) on convert(int,a.branch) = convert(int,b.BRANCH)
             union
             select distinct a.ORGEH, a.ORGEH_TX from organisasi a  with(nolock)
             left join dwh_branch b  with(nolock) on convert(int,a.branch) = convert(int,b.BRANCH)
             where b.BRANCH is null
             )
             select * from data WHERE ORGEH ='$orgeh'" );
    
         $hasil2 = $datauker->result_array();
         foreach($hasil2 as $result){
              $orgehdefinit=$result['ORGEH'];
                $namauker = $result['ORGEH_TX'];
                
            }
 
         $data=[ 
             "PERNR"=>$pernr,
             "ORGEH"=>$orgehdefinit,
             "UKER"=>$namauker,
             "CREATE_DATE"=>$tgl,
             "CREATE_BY"=>$pembuat
         ];
 
         $this->db->insert('PARAM_UKER_DEFINIT',$data);
    }

    public function lihatDataAbsen($data){
        $bulan = $this->input->post('bulan');
        $bulan= $this->input->post('bulan',true);
        $tanggal= $this->input->post('tanggal',true);
        $jenis= $this->input->post('jenis',true);
        $absen =  $this->input->post('pencarian',true);
        $uker = $this->session->userdata['logged_in']['uker'];
        if ($this->session->userdata['logged_in']['role'] === 'Admin') {
            $data['role']=1;
        }elseif ($this->session->userdata['logged_in']['role'] === 'Div') {
            $data['role']=2;
        }
                    $data['orgeh']=$this->session->userdata['logged_in']['uker'];
            $query = $this->db->query("EXEC SP_REPORT_ABSENSI_DETAIL2
            ".$data['role'].",".$data['typePosisi'].",'".$data['kode']."'
            ,'".$data['orgeh']."','".$data['orgeh']."','".$data['posisi']."'");  
            return $query->result_array();
       
    }

    public function editDataAbsensi(){
        $pembuat=  $this->session->userdata['logged_in']['id'];
        $posisi= $this->input->post('posisi',true);
        $posisi = substr($posisi,0,10);
        $pernr = $this->input->post('pern',true);
        $jammasuk= $this->input->post('jamMasuk',true);
        $jammasukAwal= $this->input->post('jamMasukAwal',true);
        $jamPulang= $this->input->post('jamPulang',true);
        $jammPulangAwal= $this->input->post('jamPulangAwal',true);
        $deskripsi= $this->input->post('kode',true);
        $keterangan =  $this->input->post('ket',true);
        $this->load->helper('date');
        date_default_timezone_set("Asia/Jakarta");
        $time = time();
        $updateat =  date('Y-m-d G:i:s',$time);
        $uker = $this->session->userdata['logged_in']['uker'];
        $kode =substr($deskripsi,0,2);
        $deskripsi = substr($deskripsi,5,10);
        $query = $this->db->query("EXEC UPDATE_DATA_ABSENSI '$jammasuk',
         '$jamPulang', 
        '$posisi', '$pernr','$jammasukAwal','$jammPulangAwal', '$keterangan', 1, '$deskripsi',
         '$kode', '$updateat', '$pembuat'");  
        return $query->result_array();
    //    $data=[
    //             "KERJA_MASUK"=>$jammasuk,
    //             "KERJA_PULANG"=>$jamPulang,
    //             "KERJA_MASUK_AWAL"=>$jammasukAwal,
    //             "KERJA_PULANG_AWAL"=>$jammPulangAwal,
    //             "KETERANGAN"=>$keterangan,
    //             "DESKRIPSI"=> $deskripsi,
    //             "KOREKSI"=>'1',
    //             "UPDATE_DATE"=>$updateat,
    //             "UPDATE_BY"=>$pembuat,
    //             "KODE"=>substr($deskripsi,0,2)
    //         ];

   
            // $this->db->where('POSISI', $posisi);
            // $this->db->where('PERNR', $pernr);
            // $this->db->update('SAMPEL_DATA', $data);
    }

    public function tampilkanParameterAbsensearch($parameter){
        $query = $this->db->query("SELECT KODE , DESKRIPSI  FROM PARAM_ABSENSI where KODE like '%$parameter%' 
        OR DESKRIPSI like '%$parameter%' and  SORT_ORDER IS NOT NULL");
        return $query->result_array();
    }
}

    