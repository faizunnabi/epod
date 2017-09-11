<?php
class User_model extends CI_model
{
	function __construct(){
        parent::__construct();
        
    }

	function check_login($login_data){
	 	$u=$login_data['uname'];
	 	$p=$login_data['upass'];
        $ans=$this->db->get_where('users',array('uname'=>$u,'upass'=>$p));
        if($ans->num_rows==1)
        {
        	return 1;
        }else{
        	return 0;
        }
    }

    public function fetch_all(){
        $query = $this->db->get("users");
        $data = $query->result();
        return $data;
    }

    public function fetch_one($id){
        $query=$this->db->get_where("users",array('id'=>$id));
        $data=$query->result();
        return $data;
    }

    public function update($id,$data){

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('users', $data);
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
        $this -> db -> delete('users');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            return 0;
        }
        return 1;
    }

    public function insert($data){
        $this->db->trans_start();
        $this->db->insert('users', $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            return 0;
        }
        return 1;
    }

}