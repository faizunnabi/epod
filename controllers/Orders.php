<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Admincontroller.php';
class Orders extends Admincontroller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('orders_model');
        $this->breadcrumbs->push('Orders','/orders');
    }
    
    public function index(){
        
        $data=$this->orders_model->fetch_all();
        $result=array(
            'records'=>$data
            );
       $this->load->view('orders/orders_view',$result);
    }

    public function view_order($id){
        $this->breadcrumbs->push('View Order','/view_order');
        $data=$this->orders_model->fetch_one($id);
        $result=array(
                'data'=>$data
            );
        $this->load->view('orders/single_order',$result);
    }

    public function new_order(){
        $this->breadcrumbs->push('New Order','/new_order');
        $this->load->view('orders/new_order.php');
    }

    public function order_insert(){
		$this->form_validation->set_rules('sname', 'Sender name', 'required');
        $this->form_validation->set_rules('saddress_line', 'Sender address line', 'required');
        $this->form_validation->set_rules('scity', 'Sender City', 'required');
        $this->form_validation->set_rules('sstate', 'Sender state', 'required');
        $this->form_validation->set_rules('spo', 'Sender PO', 'required');
        $this->form_validation->set_rules('scontact', 'Sender Contact no', 'required');
        $this->form_validation->set_rules('rname', 'Receiver name', 'required');
        $this->form_validation->set_rules('raddress_line', 'Receiver address line', 'required');
        $this->form_validation->set_rules('rcity', 'Receiver City', 'required');
        $this->form_validation->set_rules('rstate', 'Receiver state', 'required');
        $this->form_validation->set_rules('rpo', 'Receiver PO', 'required');
        $this->form_validation->set_rules('rcontact', 'Receiver Contact no', 'required');
        $this->form_validation->set_rules('ddate', 'Delivery date', 'required');
        $this->form_validation->set_rules('priority', 'Priority', 'required');
        $lati=0;$longi=0;
        if($this->input->post('rloc')!=""){
            $location=explode(",",$this->input->post('rloc'));
            $lati=$location[0];
            $longi=$location[1];
        }
        $timestamp = strtotime($this->input->post('ddate'));
        $new_date_format = date('Y-m-d H:i:s', $timestamp);
        $data=array(
                'sender_name'=>$this->input->post('sname'),
                'sender_address'=>$this->input->post('saddress_line').",".$this->input->post('scity').",".$this->input->post('sstate').",".$this->input->post('spo'),
                'sender_mobile'=>$this->input->post('scontact'),
                'recipient_name'=>$this->input->post('rname'),
                'recipient_address'=>$this->input->post('raddress_line').",".$this->input->post('rcity').",".$this->input->post('rstate').",".$this->input->post('rpo'),
                'landmark'=>$this->input->post('rland'),
                'latitude'=>$lati,
                'longitude'=>$longi,
                'recipient_mobile'=>$this->input->post('rcontact'),
                'priority'=>$this->input->post('priority'),
                'special_instructions'=>$this->input->post('special_instructions'),
                'delivery_date'=>$new_date_format
                
            );
        if ($this->form_validation->run() == FALSE)
            {
                    $this->load->view('orders/new_order.php');
            }
            else
            {
                $result=$this->orders_model->insert($data);
                if($result){
                    echo'<script>alert("order _id "'.$result.');</script>';
                    update_order_status($result,1);
                    redirect('/orders/',"location");
                }
            }
    }

    public function update_show($id){
        $this->breadcrumbs->push('Update Order','/update_show');
        $data=$this->orders_model->fetch_one($id);
        $address=$data[0]->sender_address;
        $raddress=$data[0]->recipient_address;
        $full_address = explode(",", $address);
        $r_address = explode(",", $raddress);
        $result=array(
                'data'=>$data,
                'address_firstline'=>$full_address[0],
                'city'=>$full_address[1],
                'state'=>$full_address[2],
                'po'=>$full_address[3],
                 'raddress_firstline'=>$r_address[0],
                'rcity'=>$r_address[1],
                'rstate'=>$r_address[2],
                'rpo'=>$r_address[3]   
            );
        $this->load->view('orders/edit_order',$result);
    }

    public function update_order(){
        $id=$this->input->post('order_id');
        $lati=0;$longi=0;
        if($this->input->post('rloc')!=""){
            $location=explode(",",$this->input->post('rloc'));
            $lati=$location[0];
            $longi=$location[1];
        }
        $timestamp = strtotime($this->input->post('ddate'));
        $new_date_format = date('Y-m-d H:i:s', $timestamp);
        $update_data=array(
                'sender_name'=>$this->input->post('sname'),
                'sender_address'=>$this->input->post('saddress_line').",".$this->input->post('scity').",".$this->input->post('sstate').",".$this->input->post('spo'),
                'sender_mobile'=>$this->input->post('scontact'),
                'recipient_name'=>$this->input->post('rname'),
                'recipient_address'=>$this->input->post('raddress_line').",".$this->input->post('rcity').",".$this->input->post('rstate').",".$this->input->post('rpo'),
                'landmark'=>$this->input->post('rland'),
                'latitude'=>$lati,
                'longitude'=>$longi,
                'recipient_mobile'=>$this->input->post('rcontact'),
                'priority'=>$this->input->post('priority'),
                'special_instructions'=>$this->input->post('special_instructions'),
                'delivery_date'=>$new_date_format
                
            );
        $result=$this->orders_model->update($id,$update_data);
        if($result){
            echo'<script>alert("Update Successfully");</script>';
            redirect($_SERVER['HTTP_REFERER'],"location");
        }
    }

    public function delete_order($id){
        $result=$this->orders_model->delete($id);
        if($result){
            echo'<script>alert("Deleted Successfully");</script>';
            redirect('/orders/',"location");
        }
    }
    
    
}

