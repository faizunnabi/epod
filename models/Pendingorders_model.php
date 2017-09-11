<?php

class Pendingorders_model extends CI_model
{
	function __construct(){
        parent::__construct();
        
    }

    public function fetch_all(){
    	$query = $this->db->get("pending_orders");
        $data = $query->result();
        return $data;
    }

    public function fetch_one($id){
    	$query=$this->db->get_where("pending_orders",array('id'=>$id));
    	$data=$query->result();
    	return $data;
    }

    public function update($id,$data){

    	$this->db->trans_start();
    	$this->db->where('id', $id);
    	$this->db->update('pending_orders', $data);
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
  		$this -> db -> delete('pending_orders');
  		$this->db->trans_complete();
    	if ($this->db->trans_status() === FALSE)
		{
		    return 0;
		}
		return 1;
    }

    public function insert($data,$oid){
    	$this->db->trans_start();
    	$this->db->insert('pending_orders', $data);
		$this->db->query("update orders set assigned=2 where id='$oid'");
    	$this->db->trans_complete();
    	if ($this->db->trans_status() === FALSE)
		{
		    return 0;
		}
		return 1;
    }
}