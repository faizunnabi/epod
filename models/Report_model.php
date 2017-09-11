<?php

class Report_model extends CI_model
{
    function __construct(){
        parent::__construct(); 
    }
    
    function job_report(){
       $query=$this->db->query("select o.id as order_id,u.id as user_id,u.first_name,u.last_name,u.phone,j.job_status,o.order_date,j.job_date from orders o,users u,jobs j where o.id=j.order_id and j.user_id=u.id"); 
       $data=$query->result();
       return $data;
    }

    function job_by_date($f,$t){
       $query=$this->db->query("select o.id as order_id,u.id as user_id,u.first_name,u.last_name,u.phone,j.job_status,o.order_date,j.job_date from orders o,users u,jobs j where o.id=j.order_id and j.user_id=u.id and job_date BETWEEN timestamp('$f') and timestamp('$t')"); 
       $data=$query->result();
       return $data;
    }
    
    function delivery_report(){ 
        $query=$this->db->query("select * from history_master");
        $data=$query->result();
        return $data;
    }

    function delivery_by_date($f,$t){ 
        $query=$this->db->query("select * from history_master where date BETWEEN timestamp('$f') and timestamp('$t')");
        $data=$query->result();
        return $data;
    }
    
    function order_report(){
        $query=$this->db->query("select * from orders t3 join (SELECT t1.order_id,t1.status_id,t1.date FROM order_status t1 JOIN (SELECT order_id, MAX(date) date FROM order_status GROUP BY order_id) t2 ON t1.order_id = t2.order_id AND t1.date = t2.date) t4 on t3.id=t4.order_id");
        $data=$query->result();
        return $data;
    }

    function order_by_date($f,$t){
        $query=$this->db->query("select * from orders t3 join (SELECT t1.order_id,t1.status_id,t1.date FROM order_status t1 JOIN (SELECT order_id, MAX(date) date FROM order_status GROUP BY order_id) t2 ON t1.order_id = t2.order_id AND t1.date = t2.date) t4 on t3.id=t4.order_id where t3.order_date BETWEEN timestamp('$f') and timestamp('$t')");
        $data=$query->result();
        return $data;
    }
    
    function user_report(){
        $query=$this->db->query("select id,first_name,last_name from users");
        $data=$query->result();
        return $data;
    }
    
    function fetch_rejects($id){
       $query=$this->db->query("select count(*) as rejects from jobs where job_status=3 and user_id='$id'");
       $data=$query->result();
       return $data;
    }
    
    function fetch_accepts($id){
       $query=$this->db->query("select count(*) as accepts from jobs where job_status=2 and user_id='$id'");
       $data=$query->result();
       return $data;
    }
    
    function fetch_support($id){
       $query=$this->db->query("select count(*) as tickets from support where user_id='$id'");
       $data=$query->result();
       return $data;
    }
    
}