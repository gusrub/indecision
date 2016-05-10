<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Places extends MY_Controller {

  public function __construct() 
  {
    parent::__construct();
    $this->load->model("place_model");
  }

  public function index()
  {
    $data["page_title"] = "Places";
    template_load("header", "footer", "places/index", $data);
  }

  public function find($id) 
  {    
    $place = $this->place_model->find($id);

    if(empty($place)) 
    {
      show_json_response(500, JSON_RESPONSE_ERROR, "There was an error trying to load the place. Sorry."); 
    }

    show_json_response(200, JSON_RESPONSE_OK, "Place loaded", $place);
  }

  public function my_places() 
  {
    $user_id = $this->session->user_id;
    $data["page_title"] = "My Places";
    $data["my_places"] = $this->place_model->list_by_user($user_id);

    template_load("header", "footer", "places/my_places", $data);    
  }

  public function save() 
  {
    // Validate fields
    $this->form_validation->set_rules('name', 'Place name', 'required');
    $this->form_validation->set_rules('address', 'Place address', 'required');

    if(!$this->form_validation->run()) 
    {
      show_json_response(400, JSON_RESPONSE_WARNING, "Please fill in all required data", validation_errors_array());
    } 

    $user_id = $this->session->user_id;
    $current_place_id = $this->input->post("current_place_id");
    $name = $this->input->post("name");
    $address = $this->input->post("address");
    $google_place_id = $this->input->post("google_place_id");

    if (empty($current_place_id)) 
    {
      $place = $this->place_model->create(
        array(
          "name"=>$name,
          "address"=>$address,
          "user_id"=>$user_id
        ));

      if(empty($place)) 
      {
        show_json_response(500, JSON_RESPONSE_ERROR, "There was an error trying to create the place. Sorry.");        
      }

      show_json_response(201, JSON_RESPONSE_OK, "Place created", $place);
    }
    else 
    {
      $updated = $this->place_model->update($current_place_id, 
        array(
          "name"=>$name,
          "address"=>$address,
          "user_id"=>$user_id
        ));

      if(!$updated) 
      {
        show_json_response(500, JSON_RESPONSE_ERROR, "There was an error trying to update the place. Sorry.");          
      }
      else 
      {
        show_json_response(200, JSON_RESPONSE_OK, "Place successfully updated");
      }
    }

  }

  public function remove($id) 
  {
    $deleted = $this->place_model->delete($id);

    if(!$deleted) 
    {
      show_json_response(500, JSON_RESPONSE_ERROR, "There was an error trying to delete the place. Sorry.");         
    }

    show_json_response(203, JSON_RESPONSE_OK, "Place successfully deleted");
  }

  public function get_random() 
  {
    $user_id = $this->session->user_id;
    $place = $this->place_model->get_random($user_id);

    if(empty($place)) 
    {
      show_json_response(500, JSON_RESPONSE_ERROR, "There was an error trying to get random place. Sorry.");         
    }

    show_json_response(200, JSON_RESPONSE_INFO, "Random place", $place);

  }
}
