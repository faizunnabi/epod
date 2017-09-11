<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Admincontroller.php';
class Reports extends Admincontroller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('report_model');
        $this->breadcrumbs->push('Jobs','/jobs');
    }
    
    function job_report(){
        $data=$this->report_model->job_report();
        $result=array(
            'records'=>$data
        );
        $this->load->view('reports/jobs_report',$result);
    }

    function job_by_date(){
        $fdate=$this->input->post("fdate");
        $tdate=$this->input->post("tdate");
        $data=$this->report_model->job_by_date($fdate,$tdate);
        $result=array(
            'records'=>$data
        );
        $this->load->view('reports/jobs_report',$result);
    }
    
    function delivery_by_date(){
        $fdate=$this->input->post("fdate");
        $tdate=$this->input->post("tdate");
       $data=$this->report_model->delivery_by_date($fdate,$tdate);
        $result=array(
            'records'=>$data
        );
        $this->load->view('reports/delivery_report',$result); 
    }

    function delivery_report(){
       $data=$this->report_model->delivery_report();
        $result=array(
            'records'=>$data
        );
        $this->load->view('reports/delivery_report',$result); 
    }
    
    function order_report(){
       $data=$this->report_model->order_report();
        $result=array(
            'records'=>$data
        );
        $this->load->view('reports/order_report',$result); 
    }

    function order_by_date(){
        $fdate=$this->input->post("fdate");
        $tdate=$this->input->post("tdate");
       $data=$this->report_model->order_by_date($fdate,$tdate);
        $result=array(
            'records'=>$data
        );
        $this->load->view('reports/order_report',$result); 
    }
    
    function user_report(){
        $d1=$this->report_model->user_report();
        $data=array();
        foreach($d1 as $d){
           $d2=$this->report_model->fetch_rejects($d->id);
           $d3=$this->report_model->fetch_accepts($d->id);
           $d4=$this->report_model->fetch_support($d->id);
            $res=array(
                "id"=>$d->id,
                 "first_name"=>$d->first_name,
                "last_name"=>$d->last_name,
                "rejects"=>$d2[0]->rejects,
                "accepts"=>$d3[0]->accepts,
                "tickets"=>$d4[0]->tickets
            );
            array_push($data, $res);
        }
        $result=array(
            'records'=>$data
        );
        $this->load->view('reports/user_report',$result); 
    }
}