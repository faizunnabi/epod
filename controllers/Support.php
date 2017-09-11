<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Admincontroller.php';
class support extends Admincontroller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('support_model');
        $this->breadcrumbs->push('Support','/support');
    }
    
    public function index(){
        $data=$this->support_model->fetch_all();
        $result=array(
            'records'=>$data
            );
       $this->load->view('support/support_view',$result);
    }

    public function view_ticket($id){
        $this->breadcrumbs->push('View Ticket','/view_ticket');
        $data=$this->support_model->fetch_one($id);
        $result=array(
            'data'=>$data
            );
       $this->load->view('support/single_ticket',$result);
    }

    public function new_ticket(){
        $this->breadcrumbs->push('New Ticket','/new_ticket');
        $this->load->view('support/new_ticket.php');
    }

    public function ticket_insert(){
        
        $this->form_validation->set_rules('uid', 'User ID', 'required');
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('priority', 'Priority', 'required');
        $this->form_validation->set_rules('desc', 'Description', 'required');
        $data=array(
                'user_id'=>$this->input->post('uid'),
                'subject'=>$this->input->post('subject'),
                'priority'=>$this->input->post('priority'),
                'description'=>$this->input->post('desc')    
            );
        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('support/new_ticket.php');
        }
        else
        {
            $result=$this->support_model->insert($data);
            if($result){
                echo'<script>alert("New ticket created !");</script>';
                redirect('/support/',"location");
            }
        }
    }

    public function update_show($id){
        $this->breadcrumbs->push('Edit Ticket','/update_show');
        $data=$this->support_model->fetch_one($id);
        
        $result=array(
                'data'=>$data,    
            );
        $this->load->view('support/edit_ticket',$result);
    }

    public function update_ticket(){
        $id=$this->input->post('id');
        $update_data=array(
                'user_id'=>$this->input->post('user_id'),
                 'subject'=>$this->input->post('subject'),
                 'priority'=>$this->input->post('priority'),
                 'description'=>$this->input->post('desc')       
            );
        $result=$this->support_model->update($id,$update_data);
        if($result){
            echo'<script>alert("Update Successfully");</script>';
            redirect($_SERVER['HTTP_REFERER'],"location");
        }
    }

    public function delete_ticket($id){
        $result=$this->support_model->delete($id);
        if($result){
            echo'<script>alert("Deleted Successfully");</script>';
            redirect('/Support/',"location");
        }
    }
}

