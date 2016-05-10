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
  
  <!-- Font Awesome -->
  <script src="https://use.fontawesome.com/9edc9a7ddf.js"></script>

  <!-- google maps -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvs5rBGD9ONgUYeQMOCouUR3BSPGNkmz4&libraries=places&callback=initMap"
        async defer></script>

  <!-- Custom styles and scripts -->
  <link rel="stylesheet" href="<?= base_url('css/application.css'); ?>" >
  <script src="<?= base_url('js/constants.js'); ?>"></script>
  <script src="<?= base_url('js/helpers.js'); ?>"></script>
  <script src="<?= base_url('js/google-maps.js'); ?>"></script>
  <script src="<?= base_url('js/application.js'); ?>"></script>

  <title><?= APPLICATION_TITLE ?> - <?= $page_title ?> </title>

</head>
<body class="application <?= $this->router->fetch_class() . ' ' . $this->router->fetch_method() ?>">
    <div class="container">

        <!-- Static navbar -->
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <?= anchor("places/my_places", APPLICATION_TITLE, array("class"=>"navbar-brand")); ?>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <?php if($this->session->role == "ADMIN"):  ?>
              <li class="active"><a href="<?= site_url('places/') ?>">Places <span class="sr-only">(current)</span></a></li>
              <li><a href="<?= site_url('users/') ?>">Users</a></li>
            <?php endif; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $this->session->full_name ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a id="my-profile" href="#" data-toggle="modal" data-target="#my-profile-modal">My profile</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="<?= site_url('login/do_logout'); ?>">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

      <!-- this loads the popup for profile edit -->
      <?php $this->load->view("my_profile"); ?>    