<?php

Class Tuser extends CI_Model {

    // Insert registration data in database
    public function registration_insert($data) {

        // Query to check whether username already exist or not
        $condition = "Id =" . "'" . $data['id'] . "'";
        $this->db->select('*');
        $this->db->from('TUSER');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        $this->load->helper('date');
        $data['CREATE_DATE'] = date('Y-m-d H:i:s',now());
        $data['UPDATE_DATE'] = date('Y-m-d H:i:s',now());
        $data['CREATE_BY'] = $this->session->userdata['logged_in']['id'];
        $data['UPDATE_BY'] = $this->session->userdata['logged_in']['id'];
        if ($query->num_rows() == 0) {

            // Query to insert data in database
            $this->db->insert('TUSER', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            return false;
        }
    }

    // Read data using username and password
    public function login($data) {

        $condition = "Id =" . "'" . $data['Id'] . "' AND " . "passwd =" . "'" . $data['passwd'] . "'";
        $this->db->select('*');
        $this->db->from('TUSER');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
        }

        // Read data from database to show data in admin page
    public function read_user_information($username) {

        $condition = "Id =" . "'" . $username . "'";
        $this->db->select('*');
        $this->db->from('TUSER');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function select_data(){
        $query=$this->db->query("select * from TUSER");
        return $query->result();
    }

    public function update_item($id, $uker) 
    {
        $data=array(
            'role' => $this->input->post('role'),
            'uker'=> $this->input->post('uker'),
            'ket_uker' => $uker
        );
        $this->load->helper('date');
        $data['UPDATE_BY'] = $this->session->userdata['logged_in']['id'];
        $data['UPDATE_DATE'] = date('Y-m-d H:i:s',now());
        if($id==NULL){
            return $this->db->insert('TUSER',$data);
        }else{
            $this->db->where('Id',$id);
            return $this->db->update('TUSER',$data);
        }        
    }


    public function find_item($id)
    {
        return $this->db->get_where('TUSER', array('Id' => $id))->row();
    }

    public function find_uker($params){
        $query = $this->db->query("with data as (
            select distinct a.BRANCH as ORGEH, b.BRDESC as ORGEH_TX from organisasi a with(nolock)
            inner join dwh_branch b  with(nolock) on convert(int,a.branch) = convert(int,b.BRANCH)
            union
            select distinct a.ORGEH, a.ORGEH_TX from organisasi a  with(nolock)
            left join dwh_branch b  with(nolock) on convert(int,a.branch) = convert(int,b.BRANCH)
            )
            select * from data
            where ORGEH = '$params'");
        return $query->result_array();
    }

    public function delete_item($id)
    {
        return $this->db->delete('TUSER', array('Id' => $id));
    }

    public function reset_password($id)
    {
        $this->load->helper('date');
        $data['UPDATE_BY'] = $this->session->userdata['logged_in']['id'];
        $data['UPDATE_DATE'] = date('Y-m-d H:i:s',now());
        $defaultPassword = 'admin123';
        $data['passwd'] = md5($defaultPassword);
        $this->db->where('Id',$id);
        return $this->db->update('TUSER',$data);
    }

    public function update_password($id) 
    {
        $data=array(
            'passwd' => md5($this->input->post('passwd'))
        );
        $this->load->helper('date');
        $data['UPDATE_BY'] = $this->session->userdata['logged_in']['id'];
        $data['UPDATE_DATE'] = date('Y-m-d H:i:s',now());
        if($id==NULL){
            return $this->db->insert('TUSER',$data);
        }else{
            $this->db->where('Id',$id);
            return $this->db->update('TUSER',$data);
        }        
    }

}

?>