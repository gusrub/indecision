<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> 

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>  

  <!-- Custom styles and scripts -->
  <link rel="stylesheet" href="<?= base_url('css/login.css'); ?>" >
  <link rel="stylesheet" href="<?= base_url('css/application.css'); ?>" >  
  <script src="<?= base_url('js/constants.js'); ?>"></script>
  <script src="<?= base_url('js/helpers.js'); ?>"></script>
  <script src="<?= base_url('js/login.js'); ?>"></script>

  <title><?= APPLICATION_TITLE ?> - Login </title>

</head>
<body style="background: #ededed" class="<?= $this->router->fetch_class() . ' ' . $this->router->fetch_method() ?>">
