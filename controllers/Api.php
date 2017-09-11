<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller {

     public function __construct()
     {
		parent::__construct();
        $this->load->model('api_model');
     }
    
    public function auth_user_post(){
        $postdata = file_get_contents("php://input");;
        $data_mssg="";
        $result=array();
        if (isset($postdata)) {
            $request = json_decode($postdata);
            if($request!=""){
               $uname = $request->email;
               $upass = $request->password; 
            }else{
                $data_mssg= 'Wrong credentials !';
            }
        }
        $remember=FALSE;
        if ($this->ion_auth->login($uname, $upass, $remember))
        {
            $data_mssg=$this->ion_auth->user()->result()[0]->id;
        }
        else
        {
          $data_mssg= 'Wrong credentials !';  
        }
		echo $data_mssg;	
    }

	public function jobs_post(){
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$user_id = $request->user_id;
		}
		$res=$this->api_model->fetch_jobs($user_id);
		if($res){
			$this->response([
						'result' => 'OK',
						'data' => $res
					], REST_Controller::HTTP_OK);
		}else{
			$this->response([
                    'result' => 'Error',
                    'data' => 'No result were found'
                ], REST_Controller::HTTP_OK);
		}
	}

	public function accept_job_post(){
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$job_id=$request->job_id;
			$order_id = $request->order_id;
			$user_id = $request->user_id;
		}
		$res=$this->api_model->take_job($job_id, $order_id, $user_id);
		if($res==1){
			log_activity($user_id,"Job Accepted","New job has been accepted by user id ".$user_id);
			update_order_status($order_id,3);
			echo 'ok';
		}else{
			echo $res;
		}
	}

	public function reject_job_post(){
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$job_id=$request->job_id;
			$order_id = $request->order_id;
			$user_id = $request->user_id;
		}
		$res=$this->api_model->cancel_job($job_id, $order_id, $user_id);
		if($res==1){
			log_activity($user_id,"Job Rejected","A job has been rejected by user id ".$user_id);
			echo 'ok';
		}else{
			echo $res;
		}
	}

	public function single_order_post(){
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$order_id = $request->order_id;
		}
		$data=$this->api_model->fetch_single_order($order_id);
		if($data){
			$this->response([
						'result' => 'OK',
						'data' => $data
					], REST_Controller::HTTP_OK);
		}else{
			$this->response([
                    'result' => 'Error',
                    'data' => 'No result were found'
                ], REST_Controller::HTTP_OK);
		}
	}

	public function fetch_delivery_post(){
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$user_id = $request->user_id;
		}
		$res=$this->api_model->fetch_all_delivery($user_id);
		if($res){
			$this->response([
						'result' => 'OK',
						'data' => $res
					], REST_Controller::HTTP_OK);
		}else{
			$this->response([
                    'result' => 'Error',
                    'data' => 'No result were found'
                ], REST_Controller::HTTP_OK);
		}
	}

	public function pending_post(){
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$user_id=$request->user_id;
			$order_id = $request->order_id;
			$reason = $request->reason;
		}
		$res=$this->api_model->mark_pending($order_id, $reason,$user_id);
		if($res==1){
			log_activity($user_id,"Order put on pending","New pending order created for order id ".$order_id);
			update_order_status($order_id,5);
			echo 'ok';
		}else{
			echo $res;
		}
	}

	public function camera_post(){
		$this->load->helper('string');
		$config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '2048';
        $config['file_name']='proof_'.uniqid();
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('file'))
        {
            $error = $this->upload->display_errors();
			echo $error;
        }
        else
        {
            $data =$this->upload->data();
            $media_name=$data['file_name'];
			echo $media_name;
        }
	}

	public function processing_post(){
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$order_id=$request->order_id;
			$user_id=$request->user_id;
			$r_name=$request->name;
			$r_id=$request->id_pic;
			$img=$request->drawing;
			$notes=$request->notes;
		}
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = './assets/uploads/sig_' . uniqid() . '.png';
		$fp=explode('/', $file);
		$success = file_put_contents($file, $data);
		$res=$this->api_model->delivery_process($order_id, $user_id, $r_name, $r_id, end($fp),$notes);
		if($res==1){
			log_activity($user_id,"Order delivered","Order with order id ".$order_id." has been delivered by user id ".$user_id);
			update_order_status($order_id,4);
			echo 'ok';
		}else{
			echo $res;
		}
	}

	public function history_post(){
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$uid = $request->user_id;
		}
		$res=$this->api_model->fetch_history_all($uid);
		if($res){
			$this->response([
						'result' => 'OK',
						'data' => $res
					], REST_Controller::HTTP_OK);
		}else{
			$this->response([
                    'result' => 'Error',
                    'data' => 'No result were found'
                ], REST_Controller::HTTP_OK);
		}
	}

	public function profile_post(){
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$id = $request->id;
		}
		$res=$this->api_model->fetch_profile($id);
		if($res){
			$this->response([
						'result' => 'OK',
						'data' => $res
					], REST_Controller::HTTP_OK);
		}else{
			$this->response([
                    'result' => 'Error',
                    'data' => 'No result were found'
                ], REST_Controller::HTTP_OK);
		}
	}

	public function support_ticket_post(){
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$user_id=$request->user_id;
			$subject=$request->subject;
			$priority = $request->priority;
			$description = $request->description;
		}
		$res=$this->api_model->raise_ticket($user_id, $subject, $priority, $description);
		if($res==1){
			log_activity($user_id,"Support ticket","New support ticket has been raised by user id ".$user_id);
			echo 'ok';
		}else{
			echo $res;
		}
	}

	public function fetch_ticket_post(){
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$uid = $request->user_id;
		}
		$res=$this->api_model->fetch_ticket_all($uid);	
		if($res){
			$this->response([
						'result' => 'OK',
						'data' => $res
					], REST_Controller::HTTP_OK);
		}else{
			$this->response([
                    'result' => 'Error',
                    'data' => 'No result were found'
                ], REST_Controller::HTTP_OK);
		}
	}

	public function fetch_comment_post(){
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$tid = $request->ticket_id;
		}
		$res=$this->api_model->fetch_comment_all($tid);
		if($res){
			$this->response([
						'result' => 'OK',
						'data' => $res
					], REST_Controller::HTTP_OK);
		}else{
			$this->response([
                    'result' => 'Error',
                    'data' => 'No result were found'
                ], REST_Controller::HTTP_OK);
		}
	}
	
	public function tracking_post(){
		$postdata = file_get_contents("php://input");
		$res=file_put_contents("test.txt", "shakti");
		/*$postdata=json_encode($postdata);
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$latitude=$request->latitude;
			$longitude=$request->longitude;
			$user_id=3;
		}
		$res=$this->api_model->insert_location($latitude,$longitude,$user_id);*/
		if($res){
			echo "ok";
		}else{
			echo $res;
		}
	}
}

