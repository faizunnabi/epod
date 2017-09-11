<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Admincontroller.php';
class Tracking extends Admincontroller {
    
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('tracking_model');
    }

    public function index(){
        $data=$this->tracking_model->fetch_all_tracking();
        $result=array(
            'records'=>$data
            );
       $this->load->view('tracking/track_all',$result);
    }

    public function track_one($id){
        $data=$this->tracking_model->fetch_one_tracking($id);
        $result=array(
            'records'=>$data
            );
       $this->load->view('tracking/track_one',$result);
    }

}