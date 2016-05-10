<?php
defined('BASEPATH') OR exit('No direct script access allowed');


  if ( !function_exists('log_error') )
  {

    /**
     * Checks whether a word is considered as a *bad word* or if it is a restricted word by the system
     *
     * @param string $file The filename that generated the error
     * @param string $line The line number where the error generated
     * @param string $function The function or method where the error generated
     * @param string $message A custom message to describe the error
     * @param string $errid A custom ID to identify this error in logs (optional)
     * @return string The formatted message
     */   
    function log_error($file, $line, $function, $message, $errid = NULL)
    {
      if($errid == NULL) {
        $errid = '';
      } else {
        $errid .= ':';
      }
      $log = sprintf("%s [%s@L%s] %s: %s", $errid, $file, $line, $function, $message);
      log_message('error', $log);

      return $log;
    }
  }

  if ( !function_exists('show_normal_error') )
  { 
    /**
     * Show an error to the user with the given header, http status code and description.
     *
     * If given the proper argument, the error will also be logged to the system with the data passed through
     * arguments such as the filename, line, etc. backtracing such error.
     *
     * @param string $header A header to appear in the error page. If not given, a general error header will be set.
     * @param string $message The message describing the error to the user. If not given a generic message will be set.
     * @param int $code The HTTP status code to return in the response. Defaults to 500.
     * @param boolean $log If set to TRUE, the error information will also be logged.
     * @param string $file The filename where the error was generated. You would normally want to pass __FILE__ magic constant.
     * @param int $line The line number in the file where the error was generated. You would normally want to pass __LINE__ magic constant.
     * @param string $function The function name where the error was generated. You would normally want to pass __FUNCTION__ magic constant.
     * @param string $error A message describing the error. This is a description that will be logged to the log files.    
     * @param string $error_id An optional user generated error ID. This will be saved on the logs and can be useful for later tracking.
     * @return void
     */
    function show_normal_error($header = NULL, $message = NULL, $code = NULL, $log = FALSE, $file = NULL, $line = NULL, $function = NULL, $error = NULL, $error_id = NULL) 
    {
      //Set a generic message for the user to see
      if(empty($message)) 
      {
        $message = 'This is embarrasing! but we had trouble with your last request.';
      }
      if(empty($code)) 
      {
        $code = 500;
      }
      if(empty($header)) 
      {
        $header = 'General application error';
      }

      //Save a system log if enabled
      if($log) 
      {
        log_error($file, $line, $function, $error, $error_id);
      }

      //Show the user an error
      show_error($message, $code, $header);
    }
  }

  if ( !function_exists('show_ajax_error') )
  { 
    /**
     * Will show an HTTP response as an error with a json_response object encoded as application/json as the content of the HTTP response
     *
     *
     * @param string $message The message to be returned in the json_response message description
     * @param int $status_code The HTTP status code to be returned with the HTTP response
     * @param boolean $log If set to TRUE, the error information will also be logged.
     * @param string $file The filename where the error was generated. You would normally want to pass __FILE__ magic constant.
     * @param int $line The line number in the file where the error was generated. You would normally want to pass __LINE__ magic constant.
     * @param string $function The function name where the error was generated. You would normally want to pass __FUNCTION__ magic constant.
     * @param string $error A message describing the error. This is a description that will be logged to the log files.
     * @param string $error_id An optional user generated error ID. This will be saved on the logs and can be useful for later tracking.
     * @return void
     */
    function show_ajax_error($message = NULL, $status_code = NULL, $log = FALSE, $file = NULL, $line = NULL, $function = NULL, $error = NULL, $error_id = NULL) 
    {
      //Set a generic message for the user to see
      if(empty($message)) 
      {
        $msg = 'General application error';
      }
      if(empty($status_code)) 
      {
        $status_code = 500;
      }     

      //Save a system log if enabled
      if($log) 
      {
        log_error($file, $line, $function, $error, $error_id);
      }

      //Show the user an error
      show_json_response($status_code, JSON_RESPONSE_ERROR, $message);
    }
  }   
