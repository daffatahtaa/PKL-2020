<?php

Class Menu extends CI_Model{

    public function menus() {
        $this->db->select("*");
        $this->db->from("parent_menu");
        $q = $this->db->get();
    
        $final = array();
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
    
                $this->db->select("*");
                $this->db->from("child_menu");
                $this->db->where("parent_id", $row->id);
                $q = $this->db->get();
                if ($q->num_rows() > 0) {
                    $row->children = $q->result();
                }
                array_push($final, $row);
            }
        }
        return $final;
    }
}

?>