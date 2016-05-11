<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['smtp_host'] = getenv('CI_SMTP_HOST');
$config['smtp_port'] = getenv('CI_SMTP_PORT');
$config['smtp_user'] = getenv('CI_SMTP_USER');
$config['smtp_pass'] = getenv('CI_SMTP_PWD');
$config['protocol']  = 'smtp';
$config['validate']  = true;
$config['mailtype']  = 'html';
$config['charset']   = 'utf-8';
$config['newline']   = "\r\n";