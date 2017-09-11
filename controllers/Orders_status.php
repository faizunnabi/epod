<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Admincontroller.php';
class Orders_status extends Admincontroller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('order_status');
    }
    
    public function view($id){
        $data=$this->order_status->fetch_all($id);
        $result=array(
            'records'=>$data
            );
       $this->load->view('order_status/support_view',$result);
    }

    public function view_ticket($id){
        $data=$this->order_status->fetch_one($id);
        $result=array(
            'data'=>$data
            );
       $this->load->view('order_status/single_ticket',$result);
    }

    public function new_ticket(){
        $this->load->view('order_status/new_ticket.php');
    }

    public function ticket_insert(){
        
        $data=$_POST;
        $result=$this->order_status->insert($data);
        if($result){
            echo'<script>alert("New ticket created !");</script>';
            redirect($_SERVER['HTTP_REFERER'],"location");
        }
    }

    public function update_show($id){
        $data=$this->order_status->fetch_one($id);
        
        $result=array(
                'data'=>$data,    
            );
        $this->load->view('order_status/edit_ticket',$result);
    }

    public function update_ticket(){
        $id=$this->input->post('id');
        $update_data= $_POST;
        $result=$this->order_status->update($id,$update_data);
        if($result){
            echo'<script>alert("Update Successfully");</script>';
            redirect($_SERVER['HTTP_REFERER'],"location");
        }
    }

    public function delete_ticket($id){
        $result=$this->order_status->delete($id);
        if($result){
            echo'<script>alert("Deleted Successfully");</script>';
            redirect($_SERVER['HTTP_REFERER'],"location");
        }
    }
}

