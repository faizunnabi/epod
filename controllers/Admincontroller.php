<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admincontroller extends CI_Controller {

    function __construct(){
        parent::__construct();
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {        
            redirect('auth/login');          
        }
    }
}