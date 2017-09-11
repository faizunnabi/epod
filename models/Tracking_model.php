<?php

class Tracking_model extends CI_model
{
    function __construct(){
        parent::__construct(); 
    }

    function fetch_all_tracking(){
        $qry=$this->db->query("select latitude,longitude,user_id,date from tracking where date = (select max(date) from tracking as f where f.user_id = tracking.user_id)");
        $res=$qry->result_array();
        return $res;
    }

    function fetch_one_tracking($id){
        $qry=$this->db->query("select latitude,longitude,user_id,date from tracking where user_id='$id' order by date desc limit 1");
        $res=$qry->result_array();
        return $res;
    }

}