<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model("user_model");
  }

  public function index()
  {
    $this->load->view('users/index');
  }

  public function get_current_user() 
  {
    $user_id = $this->session->user_id;
    $user = $this->user_model->find($user_id);

    if(empty($user)) 
    {
      show_json_response(500, JSON_RESPONSE_ERROR, "There was a problem getting the current user. Sorry.", $user_id); 
    }

    show_json_response(200, JSON_RESPONSE_INFO, "User data", $user);
  }

  public function save_current_user() 
  {
    // Validate fields
    $this->form_validation->set_rules('first_name', 'First name', 'required');
    $this->form_validation->set_rules('last_name', 'Last name', 'required');
    $this->form_validation->set_rules('city', 'City', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

    if(!empty($this->input->post("password")) || !empty($this->input->post("repassword"))) 
    {
      $this->form_validation->set_rules('password', 'Password', 'required');  
      $this->form_validation->set_rules('repassword', 'Password Confirmation', 'required|matches[password]');
    }

    if(!$this->form_validation->run()) 
    {
      show_json_response(400, JSON_RESPONSE_WARNING, "Please fill in all required data", validation_errors_array());
    }

    $user_id = $this->session->user_id;
    $first_name = $this->input->post("first_name");
    $last_name = $this->input->post("last_name");
    $email = $this->input->post("email");
    $city = $this->input->post("city");
    $password = $this->input->post("password");

    $updated = $this->user_model->update($user_id, array(
        "first_name"=>$first_name,
        "last_name"=>$last_name,
        "city"=>$city,
        "email"=>$email,
        "password"=>$password,
      ));

    if(!$updated) 
    {
      show_json_response(500, JSON_RESPONSE_ERROR, "There was en error trying to update the user");
    }

    show_json_response(200, JSON_RESPONSE_OK, "User settings successfully saved", validation_errors_array());    
  }
}
