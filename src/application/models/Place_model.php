<?php

class Place_model extends CI_Model 
{

  public function __construct()
  {
    parent::__construct();
  }

  public function create($values) 
  {
    if (!$this->db->insert("places", $values)) 
    {
      return FALSE;
    }

    $id = $this->db->insert_id();
    $place = $this
      ->db
      ->where("id", $id)
      ->get("places")
      ->row();

    return $place;
  }

  public function find($id)
  {
    $place = $this
      ->db
      ->where("id", $id)
      ->get("places")
      ->row();

    return $place;
  }

  public function find_by($criteria) 
  {
    $place = $this
      ->db
      ->where($criteria)
      ->get("places")
      ->row(); 

    return $place;   
  }

  public function update($id, $values) 
  {
    return $this
      ->db
      ->where("id", $id)
      ->update("places", $values);
  }

  public function delete($id)
  {
    return $this
      ->db
      ->where("id", $id)
      ->delete("places");
  }

  public function list_by_user($user_id) 
  {
    $places = $this
      ->db
      ->where("user_id", $user_id)
      ->order_by("id", "DESC")
      ->get("places");

    return $places->result();

  }

  public function get_random() 
  {
    $place = $this
      ->db
      ->order_by("RAND()")
      ->limit("1")
      ->get("places")->row();

    return $place;
  }

}