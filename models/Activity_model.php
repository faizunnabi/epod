<?php

class Activity_model extends CI_model
{
    function __construct(){
        parent::__construct(); 
    }
    
    function fetch_latest(){
        
        $this->db->order_by("id", "desc");
        $this->db->limit(20);
        $query = $this->db->get_where("events_log",array('seen'=>1)); 
        $data = $query->result();
        return $data;
    }
    
    function fetch_all(){
        
        $this->db->order_by("id", "desc");
        $this->db->limit(20);
        $query = $this->db->get("events_log"); 
        $data = $query->result();
        return $data;
    }
    
    function update_seen($id){
        $data=array(
            'seen'=>0
        );
        $this->db->trans_start();
    	$this->db->where('id', $id);
    	$this->db->update('events_log', $data);
    	$this->db->trans_complete();
    	if ($this->db->trans_status() === FALSE)
        {
            return 0;
        }
        return 1;
    }
    
    function fetch_unseen(){
        $query=$this->db->get_where("events_log",array('seen'=>1));
        $data=$query->num_rows();
        return $data;
    }
    
//    function check_update(){
//        $i=$this->db->affected_rows();
//        if($i){
//            return 1;
//        }else{
//            return 0;
//        }
//    }
}