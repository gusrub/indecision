  <div class="container-fluid login">
    <div class="row">
      <?= form_open(site_url("login/reset_password"), array("id"=>"reset-password-form", "name"=>"login-form")); ?>
        <?= form_hidden("password_reset_token", $token); ?>
      <div class="col-md-4 col-md-offset-4">
        <?= img("/img/logo.png"); ?>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <?= heading("Indecision Maker", 1); ?>
        <?= heading("Please provide a new password for $user->email below.", 3, array("id"=>"msg-heading")); ?>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <div id="alerts-container">
        </div> 
      </div>      
      <div class="col-md-4 col-md-offset-4 dismissable">
        <div class="form-group">
          <?= form_input(array("type"=>"password", "name"=>"password", "id"=>"password", "class"=>"form-control input-lg alertable", "placeholder"=>"password")); ?>        
        </div>
        <div class="form-group">
          <?= form_input(array("type"=>"password", "name"=>"re-password", "id"=>"re-password", "class"=>"form-control input-lg alertable", "placeholder"=>"confirm password")); ?>        
        </div>
        <div class="form-group">
          <?= form_button(array("name"=>"btn-reset", "class"=>"btn btn-primary btn-lg btn-block", "id"=>"btn-reset", "content"=>"change password")); ?>
        </div>
      </div> 
      <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
          <?= anchor(site_url("login/"), "go to login"); ?>    
        </div>
      </div>             
      <?= form_close(); ?>
    </div>
  </div>  
