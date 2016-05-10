<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('validation_errors_array'))
{
  function validation_errors_array()
  {
    if (FALSE === ($OBJ =& _get_validation_object()))
    {
      return array();
    }

    return $OBJ->error_array();
  }
}