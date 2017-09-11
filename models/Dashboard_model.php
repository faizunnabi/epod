<?php

class Dashboard_model extends CI_model
{
	function __construct(){
        parent::__construct();
        
    }

    function dashboard_data(){
        $stats=array();
        $q1=$this->db->query("select count(*) as n_o from orders");     
		array_push($stats, $q1->result_array());       
        $q2=$this->db->query("select count(*) as n_j from orders where assigned=1");
        array_push($stats, $q2->result_array());
        $q3=$this->db->query("select count(*) as n_h from delivery");
        array_push($stats, $q3->result_array());
        $q4=$this->db->query("select count(*) as n_s from support");
        array_push($stats, $q4->result_array());
        $q5=$this->db->query("select count(*) as n_p from pending_orders");
        array_push($stats, $q5->result_array());
        $q6=$this->db->query("select count(*) as n_u from users");
        array_push($stats, $q6->result_array());
       $q7=$this->db->query("select count(*) as n_d from history_master");
        array_push($stats, $q7->result_array());
        $q8=$this->db->query("select count(*) as n_r from jobs where job_status=3");
        array_push($stats, $q8->result_array());
        $q9=$this->db->query("select count(*) as n_ac from jobs where job_status=2");
        array_push($stats, $q9->result_array());
        $q10=$this->db->query("select count(*) as n_un from jobs where job_status=1");
        array_push($stats, $q10->result_array());
        
//        $q7=$this->db->query("select u.uname,s.subject,s.priority,s.description from users u,support s where u.id=s.user_id order by s.date desc limit 5");       
//		array_push($stats, $q7->result_array());          
//        $q8=$this->db->query("select d.order_id,u.uname,d.name,d.date from history_master d,users u where u.id=d.user_id order by d.date desc limit 5");
//        array_push($stats, $q8->result_array());
//        $q9=$this->db->query("select o.id,o.order_date,o.delivery_date,s.tag from orders o,order_status t,status_tags s where o.id=t.order_id and t.status_id=s.id limit 5");
//        array_push($stats, $q9->result_array());
//        $q10=$this->db->query("select * from pending_orders order by date desc limit 5");
//        array_push($stats, $q10->result_array());
        return $stats;
    }   
}