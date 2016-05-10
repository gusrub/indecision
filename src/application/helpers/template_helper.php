<?php 
/**
 * Helps loading templates and content within
 *
 * @author Gustavo Rubio <gustavo@sdinternetmarketing.com>
 * @filesource
 */ 

/**
 * Check environment
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
if ( !function_exists('template_load') )
{

  /**
   * Loads a template with a header, footer and content within
   *
   * @param string $header The name of the header template     
   * @param string $footer The name of the footer template     
   * @param string $layout The name of the content template to load inside the master template     
   * @param array $data Any data to be passed to both master and layout templates    
   * @return void
   *
   */     
  function template_load($header, $footer, $layout, $data = array())
  {
    $CI =& get_instance();

    if($CI == NULL) 
    {
      log_error(__FILE__, __LINE__, __FUNCTION__, "Could not load main CodeIgniter instance!");
    }

    //check variables
    if(empty($header)) 
    {
      show_normal_error(NULL, NULL, NULL, TRUE, __FILE__, __LINE__, __FUNCTION__, "'header' variable must be set to load a template");
    }
    if(empty($footer)) 
    {
      show_normal_error(NULL, NULL, NULL, TRUE, __FILE__, __LINE__, __FUNCTION__, "'footer' variable must be set to load a template");
    }     
    if(empty($layout)) 
    {
      show_normal_error(NULL, NULL, NULL, TRUE, __FILE__, __LINE__, __FUNCTION__, "'layout' variable must be set to load a template");
    }     

    //Load the template
    $CI->load->view($header, $data);
    $CI->load->view($layout, $data);
    $CI->load->view($footer, $data);
  }

}