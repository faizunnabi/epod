<?php

class Orders_model extends CI_model
{
	function __construct(){
        parent::__construct();
        
    }

    public function fetch_all(){
    	$query = $this->db->get("orders");
		$this->db->order_by('id','desc');
        $data = $query->result();
        return $data;
    }

    public function fetch_one($id){
    	$query=$this->db->get_where("orders",array('id'=>$id));
    	$data=$query->result();
    	return $data;
    }

    public function update($id,$data){

    	$this->db->trans_start();
    	$this->db->where('id', $id);
    	$this->db->update('orders', $data);
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
  		$this -> db -> delete('orders');
  		$this->db->trans_complete();
    	if ($this->db->trans_status() === FALSE)
		{
		    return 0;
		}
		return 1;
    }

    public function insert($data){
    	$this->db->trans_start();
    	$this->db->insert('orders', $data);
    	$this->db->trans_complete();
    	if ($this->db->trans_status() === FALSE)
		{
		    return 0;
		}
		$res=$this->db->query("select id from orders order by id desc limit 1");
		$id=$res->result();
		return $id[0]->id;
    }
}