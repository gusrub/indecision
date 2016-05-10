<!-- Modal -->
<div class="modal fade" id="my-profile-modal" tabindex="-1" role="dialog" aria-labelledby="my-profile-modal-title">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="my-profile-modal-title">My Profile</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <?= form_open(site_url("my_profile/save"), array("id"=>"profile-form", "name"=>"profile-form")); ?>
          <div class="col-md-12">
            <div id="profile-alerts-container">
            </div> 
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <?= form_input(array("type"=>"text", "name"=>"first_name", "id"=>"first_name", "class"=>"form-control input-lg alertable", "placeholder"=>"first name")); ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <?= form_input(array("type"=>"text", "name"=>"last_name", "id"=>"last_name", "class"=>"form-control input-lg alertable", "placeholder"=>"last name")); ?>
            </div>
          </div>          
          <div class="col-md-12">
            <div class="form-group">
              <?= form_input(array("type"=>"text", "name"=>"city", "id"=>"city", "class"=>"form-control input-lg alertable", "placeholder"=>"city")); ?>
            </div>
          </div>                                           
          <div class="col-md-12">
            <div class="form-group">
              <?= form_input(array("type"=>"email", "name"=>"email", "id"=>"email", "class"=>"form-control input-lg alertable", "placeholder"=>"email")); ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <?= form_input(array("type"=>"password", "name"=>"password", "id"=>"password", "class"=>"form-control input-lg alertable", "placeholder"=>"password")); ?>        
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <?= form_input(array("type"=>"password", "name"=>"repassword", "id"=>"repassword", "class"=>"form-control input-lg alertable", "placeholder"=>"confirm password")); ?>        
            </div>
          </div>                
          <?= form_close(); ?>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
        <button type="button" id="btn-save-profile" class="btn btn-primary btn-lg">Save changes</button>
      </div>
    </div>
  </div>
</div>