  <div class="container-fluid login">
    <div class="row">
      <?= form_open(site_url("login/request_password"), array("id"=>"request-password-form", "name"=>"request-password-form")); ?>
      <div class="col-md-4 col-md-offset-4">
        <?= img("/img/logo.png"); ?>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <?= heading("Indecision Maker", 1); ?>
        <?= heading("Request new password", 3, array("id"=>"msg-heading")); ?>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <div id="alerts-container">
        </div> 
      </div>
      <div class="col-md-4 col-md-offset-4 dismissable">
        <div class="form-group">
          <?= form_input(array("type"=>"email", "name"=>"email", "id"=>"email", "class"=>"form-control input-lg alertable", "placeholder"=>"email")); ?>
        </div>
        <div class="form-group">
          <?= form_button(array("name"=>"btn-request", "class"=>"btn btn-primary btn-lg btn-block", "id"=>"btn-request", "content"=>"request new password")); ?>
        </div>        
      </div>
      <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
          <?= anchor(site_url("login/"), "go back"); ?>    
        </div>
      </div>      
      <?= form_close(); ?>
    </div>
  </div>  
