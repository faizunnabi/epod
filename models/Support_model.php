<?php

class Support_model extends CI_model
{
	function __construct(){
        parent::__construct();
        
    }

    public function fetch_all(){
    	$query = $this->db->get("support");
        $data = $query->result();
        return $data;
    }

    public function fetch_one($id){
    	$query=$this->db->get_where("support",array('id'=>$id));
    	$data=$query->result();
    	return $data;
    }

    public function update($id,$data){

    	$this->db->trans_start();
    	$this->db->where('id', $id);
    	$this->db->update('support', $data);
    	$this->db->trans_complete();
    	if ($this->db->trans_status() === FALSE)
		{
		    return 0;
		}
		return 1;
    }

    public function delete($id){
    	$this->db->trans_start();
		$this -> db -> where('id', $id);
  		$this -> db -> delete('support');
  		$this->db->trans_complete();
    	if ($this->db->trans_status() === FALSE)
		{
		    return 0;
		}
		return 1;
    }

    public function insert($data){
    	$this->db->trans_start();
    	$this->db->insert('support', $data);
    	$this->db->trans_complete();
    	if ($this->db->trans_status() === FALSE)
		{
		    return 0;
		}
		return 1;
    }
}