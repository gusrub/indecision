  <div class="container-fluid login">
    <div class="row">
      <?= form_open(site_url("login/do_login"), array("id"=>"login-form", "name"=>"login-form")); ?>
      <div class="col-md-4 col-md-offset-4">
        <?= img("/img/logo.png"); ?>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <?= heading("Indecision Maker", 1); ?>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <div id="alerts-container">
        <?php if($this->session->flashdata('flash')): ?>
          <div class="alert alert-<?= $this->session->flashdata('flash')['level'] ?> alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><?= $this->session->flashdata('flash')["message"] ?></div>          
        <?php endif ?>
        </div> 
      </div>      
      <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
          <?= form_input(array("type"=>"email", "name"=>"username", "id"=>"username", "class"=>"form-control input-lg alertable", "placeholder"=>"username")); ?>
        </div>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
          <?= form_input(array("type"=>"password", "name"=>"password", "id"=>"password", "class"=>"form-control input-lg alertable", "placeholder"=>"password")); ?>        
        </div>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
          <?= form_button(array("name"=>"btn-login", "class"=>"btn btn-primary btn-lg btn-block", "id"=>"btn-login", "content"=>"login")); ?>
        </div>
      </div> 
      <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
          <?= anchor(site_url("login/forgot_password"), "I forgot my password"); ?>    
        </div>
      </div>      
      <?= form_close(); ?>
    </div>
  </div>  
