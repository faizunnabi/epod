<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Admincontroller.php';
class ActivityLogs extends Admincontroller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('activity_model');
    }
    
    function fetch_notification(){
        $data=$this->activity_model->fetch_latest();
        $unseen=$this->activity_model->fetch_unseen();
        $res='';
        if(!empty($data)){
        foreach($data as $d){
            if($d->seen==0){
            $res.='<li id="noti_'.$d->id.'"><a href="#" onclick="update_seen('.$d->id.');"><strong>'.$d->activity.'</strong><br/><small><em>'.$d->message.'</em><br/>'.$d->date.'</small></a></li>';
            
            }else{
               $res.='<li class="unseen" id="noti_'.$d->id.'"><a href="#" onclick="update_seen('.$d->id.');"><strong>'.$d->activity.'</strong><br/><small><em>'.$d->message.'</em><br/>'.$d->date.'</small></a></li>';
             
            }
        }
        }else{
            $res .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
        }
        
        $data_res = array(
            'notification'   => $res,
            'unseen_notification' => $unseen
        );
        echo json_encode($data_res);
    }
    
    function update_notification(){
        $id=$_POST['id'];
        $res=$this->activity_model->update_seen($id);
        if($res){
            echo "ok";
        }
    }

    function fetch_all(){
        $data=$this->activity_model->fetch_all();
        $res='';
        if(!empty($data)){
        foreach($data as $d){
            if($d->seen==0){
            $res.='<li id="noti_'.$d->id.'"><a href="#" onclick="update_seen('.$d->id.');"><strong>'.$d->activity.'</strong><br/><small><em>'.$d->message.'</em><br/>'.$d->date.'</small></a></li>';
            
            }else{
               $res.='<li class="unseen" id="noti_'.$d->id.'"><a href="#" onclick="update_seen('.$d->id.');"><strong>'.$d->activity.'</strong><br/><small><em>'.$d->message.'</em><br/>'.$d->date.'</small></a></li>';
             
            }
        }
        }else{
            $res .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
        }
        
        $data_res = array(
            'notification'   => $res
        );
        echo json_encode($data_res);
    }
}
