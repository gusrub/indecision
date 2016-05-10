<?php

class User_model extends CI_Model 
{

  public function __construct()
  {
    parent::__construct();
  }

  public function create($values) 
  {
    if (!$this->db->insert("users", $values)) 
    {
      return FALSE;
    }

    $id = $this->db->insert_id();
    $user = $this
      ->db
      ->where("id", $id)
      ->get("users")
      ->row();

    return $user;
  }

  public function find($id)
  {
    $user = $this
      ->db
      ->where("id", $id)
      ->get("users")
      ->row();

    return $user;
  }

  public function find_by($criteria) 
  {
    $user = $this
      ->db
      ->where($criteria)
      ->get("users")
      ->row();    

    return $user;
  }

  public function update($id, $values) 
  {
    # We dont want to set password to null ever
    if (array_key_exists("password", $values)) 
    {
      if (empty($values["password"])) 
      {
        unset($values["password"]);
      }
      else 
      {
        $values["password"] = password_hash($values["password"], PASSWORD_DEFAULT);
      }
    }

    return $this
      ->db
      ->where("id", $id)
      ->update("users", $values);
  }

  public function delete($id)
  {
    return $this
      ->db
      ->where("id", $id)
      ->delete("users");
  }

  public function authenticate($username, $password) 
  {
    $user = $this
      ->db
      ->where("email", $username)
      ->get('users')
      ->row();

    if (empty($user)) 
    {
      return FALSE;
    }
    if (!password_verify($password, $user->password)) 
    {
      return FALSE;
    }

    return $user;
  }

  public function gen_password_reset_token($id) 
  {
    $token = bin2hex($this->security->get_random_bytes(16));
    $expiration = date_create();
    date_add($expiration, date_interval_create_from_date_string("15 days"));
    $expiration = date_format($expiration,"Y-m-d H:i:s");

    $values = array(
      "password_reset_token" => $token,
      "password_reset_expiration" => $expiration
    );

    if($this->db->where("id", $id)->update("users", $values)) 
    {
      return $token;
    }

    return FALSE;
  }

  public function reset_password($token, $password) 
  {
    $new_password = password_hash($password, PASSWORD_DEFAULT);

    # try tu update password and reset the token info
    return $this
      ->db
      ->where("password_reset_token", $token)
      ->update("users", 
        array(
          "password" => $new_password,
          "password_reset_token" => NULL,
          "password_reset_expiration" => NULL
        ));
  }
}