<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();

    $logged_in = $this->session->is_logged_in;

    if(!$logged_in) 
    {
      $this->session->set_flashdata('flash',
        array(
          "level"=>JSON_RESPONSE_WARNING,
          "message"=>"You need to login to access that page!"
        ));
      redirect("login/");
    }
  }
}