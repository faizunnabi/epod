<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Admincontroller.php';
class Jobs extends Admincontroller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('jobs_model');
        $this->breadcrumbs->push('Jobs','/jobs');
    }
    
    public function index(){
        $data=$this->jobs_model->fetch_all();
        $result=array(
            'records'=>$data
            );
       $this->load->view('jobs/jobs_view',$result);
    }

    public function view_job($id){
        $this->breadcrumbs->push('View Job','/view_job');
        $data=$this->jobs_model->fetch_one($id);
        $result=array(
                'data'=>$data
            );
        $this->load->view('jobs/single_job',$result);
    }

    public function new_job(){
        $this->breadcrumbs->push('New Job','/new_job');
        $this->load->view('jobs/new_job.php');
    }

    public function job_insert(){
        $this->form_validation->set_rules('order_id', 'Order ID', 'required');
        $this->form_validation->set_rules('user_id', 'User ID', 'required');
        $this->form_validation->set_rules('job_status', 'Job status', 'required');
        $this->form_validation->set_rules('jdate', 'Job date', 'required');
        $timestamp = strtotime($this->input->post('jdate'));
        $new_date_format = date('Y-m-d H:i:s', $timestamp);
        $data=array(
                'order_id'=>$this->input->post('order_id'),
                'user_id'=>$this->input->post('user_id'),
                'job_status'=>$this->input->post('job_status'),
                'job_date'=>$new_date_format       
            );
            if ($this->form_validation->run() == FALSE)
            {
                    $this->load->view('jobs/new_job.php');
            }
            else
            {
                $result=$this->jobs_model->insert($data,$this->input->post('order_id'));
                if($result){
                    update_order_status($this->input->post('order_id'),2);
                    echo'<script>alert("New job created !");</script>';
                    redirect('/jobs/',"location");
                }
            }
    }

    public function update_show($id){
        $this->breadcrumbs->push('Update Job','/update_show');
        $data=$this->jobs_model->fetch_one($id);
        
        $result=array(
                'data'=>$data,    
            );
        $this->load->view('jobs/edit_job',$result);
    }

    public function update_job(){
        $id=$this->input->post('id');
        $timestamp = strtotime($this->input->post('jdate'));
        $new_date_format = date('Y-m-d H:i:s', $timestamp);
        
        $update_data=array(
                'order_id'=>$this->input->post('order_id'),
                'user_id'=>$this->input->post('user_id'),
                'job_status'=>$this->input->post('job_status'),
                'job_date'=>$new_date_format,               
            );
        $result=$this->jobs_model->update($id,$update_data);
        if($result){
            echo'<script>alert("Update Successfully");</script>';
            redirect($_SERVER['HTTP_REFERER'],"location");
        }
    }

    public function delete_job($id){
        $result=$this->jobs_model->delete($id);
        if($result){
            echo'<script>alert("Deleted Successfully");</script>';
            redirect('/jobs/',"location");
        }
    }
}

