<?php 

if(!function_exists('convert_id'))
{
    function convert_id($id,$table)
    {
        $CI =&get_instance();
        $ans=$CI->db->get_where($table,array('id'=>$id))->result();
        if($ans==NULL)
        {
               echo"<p>Error !</p>";
        }
       else
        {
            return $ans[0];
        }
    }
}

if(!function_exists('convert_snaps'))
{
    function convert_snaps($str)
    {
        $res= explode("/", $str);
        $output='';
        for($i=0;$i<sizeof($res)-1;$i++){
            $output.='<a href="http://104.131.94.246/epod/assets/uploads/'.$res[$i].'" target="_blank">'.$res[$i].'</a><br/>';
        }

        return $output;
    }
}

if(!function_exists('dropdown_tool'))
{
    function dropdown_tool($table,$name,$selected,$where)
    {
        $CI =&get_instance();
        $ans=$CI->db->get_where($table,$where)->result();
        $sel="";
        $output="";
        if($ans!=NULL)
        {
            foreach($ans as $a){
                if($a->id==$selected){
                    $sel="selected";
                }else{
                    $sel="";
                }
                $output.= '<option '.$sel.' value='.$a->id.'>'.$a->$name.'</option>';
                
            }
            echo $output;
        }
       else
        {
            $output= "<option>No data present</option>";
            echo $output;
        }
    }
}

if(!function_exists('update_order_status'))
{
    function update_order_status($order_id,$status_id)
    {
		$CI =&get_instance();
		$CI->db->trans_start();
		$CI->db->query("insert into order_status(order_id,status_id) values('$order_id','$status_id')");
		$CI->db->trans_complete();
		if ($CI->db->trans_status() === FALSE)
		{
			return $this->db->_error_message();
		}
		return 1;
	}
}

if(!function_exists('log_activity'))
{
    function log_activity($user_id,$activity,$message)
    {
		$CI =&get_instance();
		$CI->db->trans_start();
		$CI->db->query("insert into events_log(user_id,message,activity) values('$user_id','$message','$activity')");
		$CI->db->trans_complete();
		if ($CI->db->trans_status() === FALSE)
		{
			return $this->db->_error_message();
		}
		return 1;
	}
}
