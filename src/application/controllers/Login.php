<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct() 
  {
    parent::__construct();
    $this->load->model("user_model");
  }

  public function index()
  {
    if ($this->session->is_logged_in) 
    {
      redirect("places/");
    }

    template_load("login/header", "login/footer", "login/index");
  }

  public function do_login() 
  {
    // Validate fields
    $this->form_validation->set_rules('username', 'Username', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if(!$this->form_validation->run()) 
    {
      show_json_response(400, JSON_RESPONSE_WARNING, "Please fill in all required fields", validation_errors_array());
    } 

    // Lookout for the user
    $username = $this->input->post("username");
    $password = $this->input->post("password");

    $user = $this->user_model->authenticate($username, $password);

    if (empty($user)) 
    {
      show_json_response(401, JSON_RESPONSE_WARNING, "Wrong username or password");
    } 
    else 
    {
      $this->session->set_userdata(
        array(
          "user_id"=>$user->id,
          "username"=>$user->email,
          "full_name"=>"$user->first_name $user->last_name",
          "role"=>$user->role,
          "is_logged_in"=>TRUE));

      show_json_response(200, JSON_RESPONSE_OK, "User successfully logged in");
    }    

  }

  public function do_logout() 
  {
    $this->session->sess_destroy();
    redirect("login");
  }

  public function forgot_password() 
  {
    template_load("login/header", "login/footer", "login/forgot_password");
  }

  public function request_new_password() 
  {
    // Validate fields
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

    if(!$this->form_validation->run()) 
    {
      show_json_response(400, JSON_RESPONSE_WARNING, "Please fill in all required fields", validation_errors_array());
    }

    # Find the user
    $email = $this->input->post("email");
    $user = $this->user_model->find_by(array("email"=>$email));

    # No user found
    if (empty($user)) 
    {
      show_json_response(404, JSON_RESPONSE_WARNING, "No user found with the given email");      
    }

    # Generate token
    $token = $this->user_model->gen_password_reset_token($user->id);
    if(empty($token)) 
    {

      show_json_response(500, JSON_RESPONSE_ERROR, "There was a problem generating a password reset token. Sorry.");  
    } 

    # Send email for email reset
    $subject = "Your password reset request";
    $message = "Please click on the following link to reset your password, thanks:\n\n";
    $message .= base_url("login/reset_password/$token");


    # $this->email->from('gustavo.rubio@gmail.com', 'Gustavo');
    # $this->email->to($user->email);
    # $this->email->subject($subject);
    # $this->email->message($message);
    # $this->email->send();

    show_json_response(200, JSON_RESPONSE_OK, "Password reset link successfully sent for user $user->email. Please check your email for further instructions.");     
  }

  public function reset_password($token = NULL) 
  {
    # disregard access here without a token
    if (empty($token)) 
    {
      redirect("login/");
    }

    # lookup the actual user by the token
    $user = $this->user_model->find_by(array("password_reset_token"=>$token));

    # no user found for this token
    if (empty($user)) 
    {
      show_normal_error("No password reset request found", "No password reset request was found, please double check your email or request a new one.");      
    }

    # check expiration date of token
    $now = date("YmdHis");
    $expiration = date("YmdHis", strtotime($user->password_reset_expiration));

    if ($now > $expiration) 
    {
      show_normal_error("Password reset expired", "Your password reset expiration token has expired. Please request a new password");
    }

    template_load("login/header", "login/footer", "login/reset_password", array("user"=>$user, "token"=>$token));
  }

  public function save_new_password() 
  {
    // Validate fields
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('re-password', 'Password Confirmation', 'required|matches[password]');

    if(!$this->form_validation->run()) 
    {
      show_json_response(400, JSON_RESPONSE_WARNING, "Please check all required fields", validation_errors_array());
    }

    $token = $this->input->post("password_reset_token");
    $password = $this->input->post("password");

    # reset password
    if(!$this->user_model->reset_password($token, $password)) 
    {
      show_json_response(500, JSON_RESPONSE_ERROR, "There was a problem tryging to reset the password. Sorry.");
    }

    show_json_response(200, JSON_RESPONSE_OK, "Password has been successfully reset. You can now login with the new credentials.");

  }
}
