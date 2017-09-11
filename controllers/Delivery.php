<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Admincontroller.php';
class Delivery extends Admincontroller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('delivery_model');
        $this->breadcrumbs->push('Deliveries','/delivery');
    }
    
    public function index(){
        $data=$this->delivery_model->fetch_all();
        $result=array(
            'records'=>$data
            );
       $this->load->view('deliveries/delivery_view',$result);
    }

    public function view_delivery($id){
        $this->breadcrumbs->push('View Delivery','/view_delivery');
        $data=$this->delivery_model->fetch_one($id);
        $result=array(
                'data'=>$data
            );
        $this->load->view('deliveries/single_delivery',$result);
    }

    public function new_delivery(){
        $this->breadcrumbs->push('New Delivery','/new_delivery');
        $this->load->view('deliveries/new_delivery.php');
    }

    public function delivery_insert(){
        
        $this->form_validation->set_rules('job_id', 'Job ID', 'required');
        $this->form_validation->set_rules('order_id', 'Order ID', 'required');
        $this->form_validation->set_rules('user_id', 'User ID', 'required');
        $this->form_validation->set_rules('ddate', 'Delivery date', 'required');
        $timestamp = strtotime($this->input->post('ddate'));
        $new_date_format = date('Y-m-d H:i:s', $timestamp);
        $data=array(
                'job_id'=>$this->input->post('jobid'),
                'order_id'=>$this->input->post('orderid'),
                'user_id'=>$this->input->post('userid'),
                'd_date'=>$new_date_format       
            );
        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('deliveries/new_delivery.php');
        }
        else
        {
            $result=$this->delivery_model->insert($data);
            if($result){
                echo'<script>alert("New job created !");</script>';
                redirect('/delivery/',"location");
            }
        }
    }

    public function update_show($id){
        $this->breadcrumbs->push('Update Delivery','/update_show');
        $data=$this->delivery_model->fetch_one($id);
        
        $result=array(
                'data'=>$data,    
            );
        $this->load->view('deliveries/edit_delivery',$result);
    }

    public function update_delivery(){
        $id=$this->input->post('id');
        $timestamp = strtotime($this->input->post('ddate'));
        $new_date_format = date('Y-m-d H:i:s', $timestamp);
        $update_data=array(
                'job_id'=>$this->input->post('jobid'),
                'order_id'=>$this->input->post('orderid'),
                'user_id'=>$this->input->post('userid'),
                'delivery_date'=>$new_date_format              
            );
        $result=$this->delivery_model->update($id,$update_data);
        if($result){
            echo'<script>alert("Update Successfully");</script>';
            redirect($_SERVER['HTTP_REFERER'],"location");
        }
    }

    public function delete_delivery($id){
        $result=$this->delivery_model->delete($id);
        if($result){
            echo'<script>alert("Deleted Successfully");</script>';
            redirect('/delivery/',"location");
        }
    }
}

