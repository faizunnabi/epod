<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Admincontroller.php';
class Dashboard extends Admincontroller {
    
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('dashboard_model');
    }

    public function index(){
    	$data=$this->dashboard_model->dashboard_data();
    	//print_r($data);
    	$stats=array(
    			'n_od'=>$data[0][0]["n_o"],
    			'n_jo'=>$data[1][0]["n_j"],
    			'n_hi'=>$data[2][0]["n_h"],
    			'n_su'=>$data[3][0]["n_s"],
    			'n_pe'=>$data[4][0]["n_p"],
    			'n_us'=>$data[5][0]["n_u"],
    			'n_d'=>$data[6][0]["n_d"],
                'n_r'=>$data[7][0]["n_r"],
                'n_ac'=>$data[8][0]["n_ac"],             
                'n_un'=>$data[9][0]["n_un"]
                //'n_ud'=>$this->db->query("select * from (select * from order_status order by date desc) as sub group by order_id")->num_rows()
    		);
    	$this->load->view('dashboard/dashboard.php',$stats);    	
        //print_r($stats);
    }   

    public function test_data(){
    	$data=$this->dashboard_model->dashboard_data();
    	$stats=array(
                    'n_od'=>$data[0][0]["n_o"],
                    'n_jo'=>$data[1][0]["n_j"],
                    'n_hi'=>$data[2][0]["n_h"],
                    'n_su'=>$data[3][0]["n_s"],
                    'n_pe'=>$data[4][0]["n_p"],
                    'n_us'=>$data[5][0]["n_u"],
                    'n_d'=>$data[6][0]["n_d"],
                    'n_r'=>$data[7][0]["n_r"],
                    'n_ac'=>$data[8][0]["n_ac"],
                    'n_un'=>$data[9][0]["n_un"],
                    
    		);
        echo json_encode($stats);
    }
}