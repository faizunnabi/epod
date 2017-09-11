<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Admincontroller.php';
class supportthreads extends Admincontroller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('support_thread');
        $this->breadcrumbs->push('Support Tickets','/support/');
    }
    
    public function view($id){
        $data=$this->support_thread->fetch_all($id);
        $result=array(
            'records'=>$data
            );
       $this->load->view('support_thread/support_view',$result);
    }

    public function view_ticket($id){
        $this->breadcrumbs->push('Thread details','/view_ticket');
        $data=$this->support_thread->fetch_one($id);
        $result=array(
            'data'=>$data
            );
       $this->load->view('support_thread/single_ticket',$result);
    }

    public function new_ticket(){
        $this->breadcrumbs->push('New Thread','/new_ticket');
        $this->load->view('support_thread/new_ticket.php');
    }

    public function ticket_insert(){
        
        $data=$_POST;
        $result=$this->support_thread->insert($data);
        if($result){
            echo'<script>alert("New ticket created !");</script>';
            redirect('/supportthreads/view/'.$_POST['ticket_id'],"location");
        }
    }

    public function update_show($id){
        $this->breadcrumbs->push('Edit Thread','/update_show');
        $data=$this->support_thread->fetch_one($id);
        
        $result=array(
                'data'=>$data,    
            );
        $this->load->view('support_thread/edit_ticket',$result);
    }

    public function update_ticket(){
        $id=$this->input->post('id');
        $update_data= $_POST;
        $result=$this->support_thread->update($id,$update_data);
        if($result){
            echo'<script>alert("Update Successfully");</script>';
            redirect('/supportthreads/view/'.$this->input->post('ticket_id'),"location");
        }
    }

    public function delete_ticket($id){
        $result=$this->support_thread->delete($id);
        if($result){
            echo'<script>alert("Deleted Successfully");</script>';
            redirect($_SERVER['HTTP_REFERER'],"location");
        }
    }
}

