<?php

class Api_model extends CI_model
{
    function __construct(){
        parent::__construct(); 
    }
    
    public function fetch_orders(){
    	$query = $this->db->get("orders");
        $data = $query->result_array();
        return $data;
    }

    public function fetch_jobs($id){
        $query=$this->db->query("select o.id,o.recipient_name,o.recipient_address,o.landmark,o.recipient_mobile,o.priority,j.id as job_id,j.job_date from jobs j,orders o where j.job_status=1 and j.order_id=o.id and j.user_id='$id' order by j.job_date desc");
		$data=$query->result_array();
		return $data;
    }
    
	public function take_job($j,$o,$u){
		$this->db->trans_start();
		$this->db->query("insert into delivery(job_id,order_id,user_id) values('$j','$o','$u')");
		$this->db->query("update jobs set job_status=2 where id='$j'");
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			return $this->db->_error_message();
		}
		return 1;		
	}

	public function cancel_job($j,$o,$u){
		$this->db->trans_start();
		//$this->db->query("update orders set assigned=0 where id='$o'");
		$this->db->query("update jobs set job_status=3 where id='$j'");
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			return $this->db->_error_message();
		}
		return 1;
	}

	public function fetch_single_order($id){
		$query=$this->db->query("select * from orders where id='$id'");
		$data=$query->result_array();
		return $data;
	}

	public function fetch_all_delivery($u){
		$query=$this->db->query("select o.id,o.recipient_name,o.recipient_address,o.landmark,o.latitude,o.longitude,o.recipient_mobile,o.priority,d.job_id,d.d_date from delivery d,orders o where d.order_id=o.id and d.user_id='$u' order by d.d_date desc");
		$data=$query->result_array();
		return $data;
	}

	public function mark_pending($o,$r,$u){
		$this->db->trans_start();
		$this->db->query("insert into pending_orders(order_id,reason,user_id) values('$o','$r','$u')");
		$this->db->query("delete from delivery where order_id='$o'");
		$this->db->query("update orders set assigned=2 where id='$o'");
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			return $this->db->_error_message();
		}
		return 1;
	}

	public function delivery_process($o,$u,$rn,$ri,$rf,$n){
		$this->db->trans_start();
		$this->db->query("insert into history_master(order_id,user_id,name,idcard,signature,notes) values('$o','$u','$rn','$ri','$rf','$n')");
		$this->db->query("delete from delivery where order_id='$o'");
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			return $this->db->_error_message();
		}
		return 1;
	}

	public function fetch_history_all($u){
		$query=$this->db->query("select * from history_master where user_id='$u' order by date desc");
		$data=$query->result_array();
		return $data;
	}

	public function fetch_profile($i){
		$query=$this->db->query("select * from users where id='$i'");
		$data=$query->result_array();
		return $data;
	}

	public function raise_ticket($u,$s,$p,$d){
		$this->db->trans_start();
		$query=$this->db->query("insert into support(user_id,subject,priority,description) values('$u','$s','$p','$d')");
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			return $this->db->_error_message();
		}
		return 1;
	}

	public function fetch_ticket_all($uid){
		$query=$this->db->query("select * from support where user_id='$uid' order by date desc");
		$data=$query->result_array();
		return $data;
	}

	public function fetch_comment_all($tid){
		$query=$this->db->query("select * from support_comment where ticket_id='$tid' order by date desc");
		$data=$query->result_array();
		return $data;
	}
	
	public function insert_location($la,$lo,$u){
		$this->db->trans_start();
		$query=$this->db->query("insert into tracking(latitude,longitude,user_id) values('$la','$lo','$u')");
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			return $this->db->_error_message();
		}
		return 1;
	}
}

