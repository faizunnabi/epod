<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Admincontroller.php';

class PendingOrders extends Admincontroller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('pendingorders_model');
        $this->breadcrumbs->push('PendingOrders','/pendingorders');
    }
    
    public function index(){
        $data=$this->pendingorders_model->fetch_all();
        $result=array(
            'records'=>$data
            );
       $this->load->view('pending/pendingorder_view',$result);
    }

    public function new_pendingorder(){
        $this->breadcrumbs->push('New Pending','/new_pendingorder');
        $this->load->view('pending/new_pendingorder.php');
    }

    public function pendingorder_insert(){
        
        $this->form_validation->set_rules('order_id', 'Order ID', 'required');
        $this->form_validation->set_rules('reason', 'Reason', 'required');
        $this->form_validation->set_rules('user_id', 'User Id', 'required');
        $data=array(
                'order_id'=>$this->input->post('order_id'),
                'reason'=>$this->input->post('reason'),  
				'user_id'=>$this->input->post('user_id')
            );
        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('pending/new_pendingorder.php');
        }
        else
        {
            $result=$this->pendingorders_model->insert($data,$this->input->post('order_id'));
            if($result){
                echo'<script>alert("New job created !");</script>';
                redirect('/pendingorders/',"location");
            }
        }
    }

    public function update_show($id){
        $this->breadcrumbs->push('Update Pending','/update_show');
        $data=$this->pendingorders_model->fetch_one($id);
        
        $result=array(
                'data'=>$data,    
            );
        $this->load->view('pending/edit_pendingorder',$result);
    }

    public function update_pendingorder(){
        $id=$this->input->post('id');
        $update_data=array(
                'order_id'=>$this->input->post('order_id'),
                'reason'=>$this->input->post('reason'),    
				'user_id'=>$this->input->post('user_id')      
            );
        $result=$this->pendingorders_model->update($id,$update_data);
        if($result){
            echo'<script>alert("Update Successfully");</script>';
            redirect($_SERVER['HTTP_REFERER'],"location");
        }
    }

    public function delete_order($id){
        $result=$this->pendingorders_model->delete($id);
        if($result){
            echo'<script>alert("Deleted Successfully");</script>';
            redirect('/PendingOrders/',"location");
        }
    }
}

