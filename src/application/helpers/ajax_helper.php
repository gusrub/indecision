<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( !function_exists('check_ajax_call') )
{
  /**
   * Checks whether an HTTP request is made by ajax or not and redirects accordingly
   * 
   * @param boolean $should_be Whether the function should check for a valid  XmlHttpRequest or not
   * @return void
   */   
  function check_ajax_call($should_be = TRUE)
  {
    $CI =& get_instance();

    if($CI == NULL) {
      log_error(__FILE__, __LINE__, __FUNCTION__, "Could not load main CodeIgniter instance!");
    }

    $is_ajax = $CI->input->is_ajax_request();

    if($is_ajax && !$should_be) {
      show_ajax_error('You should not try to access this resource directly!', 405);
    } else if (($is_ajax == FALSE) && $should_be) {
      show_normal_error('Unauthorized', 'This resource should be accessed only by XmlHttpRequest', 405);
    }
  }
}

if ( !function_exists('json_response') )
{
  /**
   * Creates a JSON_RESPONSE object based on the parameters.
   *
   * This function will create a standarized response object which can be used to transport
   * serialized object data in a way that we always know what to expect.
   *
   * @param int $level Any of the following constant level values: JSON_RESPONSE_OK, JSON_RESPONSE_INFO, JSON_RESPONSE_WARNING, JSON_RESPONSE_ERROR 
   * @param string $message The response message.
   * @param mixed $data Any data needed to be returned to the caller. It will be serialized as possible.
   * @return string A json string containing a serialized response object      
   */     
  function json_response($level, $message = NULL, $data = NULL, $pretty=FALSE)
  {

    $response = array(
      'level' => $level,
      'message' => $message,
      'data' => $data);

    if(!defined('JSON_PRETTY_PRINT')) 
    {
      $result = json_encode($response);
    } 
    else 
    {
      if($pretty) 
      {
        $result = json_encode($response, JSON_PRETTY_PRINT);
      } 
      else 
      {
        $result = json_encode($response);
      }       
    }
    

    $json_error = json_last_error_msg();
    if($json_error != NULL && $json_error != "No error") 
    {
      log_error(__FILE__, __LINE__, __FUNCTION__, "Error while encoding a json response: {$json_error}");
    }

    return $result;
  }

}

if (!function_exists('json_last_error_msg')) 
{

  /**
   * Just a backport of the PHP 5.5 json_last_error_msg() function to help us out.
   *
   * Will return a string description of the last json error when trying to encode/decode if there was one.
   * 
   * @return string
   */     
    function json_last_error_msg() 
    {
        static $errors = array(
            JSON_ERROR_NONE             => 'No error',
            JSON_ERROR_DEPTH            => 'Maximum stack depth exceeded',
            JSON_ERROR_STATE_MISMATCH   => 'Underflow or the modes mismatch',
            JSON_ERROR_CTRL_CHAR        => 'Unexpected control character found',
            JSON_ERROR_SYNTAX           => 'Syntax error, malformed JSON',
            JSON_ERROR_UTF8             => 'Malformed UTF-8 characters, possibly incorrectly encoded'
        );
        $error = json_last_error();
        return array_key_exists($error, $errors) ? $errors[$error] : "Unknown error ({$error})";
    }
}

if(!function_exists('show_json_response'))  
{
  /**
   * Creates a new json_response object and returns it as an HTTP response automatically.
   *
   * Note that if you call this method, execution of the script will terminate and an HTTP
   * response with an application/json mime type will be returned.
   *
   * @param int $status_code The HTTP status code to return on the request
   * @param string $level Any JSON_RESPONSE_* level constant value
   * @param string $message The message that will be returned in the json response
   * @param mixed $data Any extra information to be returned in the json response
   * @return void
   */
  function show_json_response($status_code, $level, $message = NULL, $data = NULL)
  {
    $CI =& get_instance();

    if($CI == NULL) 
    {
      log_error(__FILE__, __LINE__, __FUNCTION__, "Could not load main CodeIgniter instance!");
    }

    //By default we create a response with an error code and set the 
    //same message as the one we'll send in the headers
    $response = json_response($level, $message, $data, TRUE);
    $CI->output->set_status_header($status_code);
    
    //Return content as JSON, fo'real
    $CI->output->set_content_type('application/json');
    $CI->output->set_output($response);

    //Send the buffer to the output and exit afterwards, so that nothing continues
    //execution after the user has actually requested to return a json response ;)
    $CI->output->_display();
    exit;
  }
} 