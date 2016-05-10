<div class="row">
  <!-- left area -->
  <div class="col-md-6">
    <!-- add/edit panel -->
    <div class="panel panel-default">
      <div class="panel-body">
        <?= form_open(site_url("places/save"), array("name"=>"save-form", "id"=>"save-form")); ?>
        <div id="save-form-alerts-container">
        </div>              
        <?= form_input(array("type"=>"hidden", "name"=>"current_place_id", "id"=>"current_place_id")); ?>
        <?= form_input(array("type"=>"hidden", "name"=>"google_place_id", "id"=>"google_place_id")); ?>
        <div class="form-group">
          <?= form_input(array("type"=>"text", "name"=>"name", "id"=>"name", "class"=>"form-control input-lg alertable", "placeholder"=>"Name")); ?>
        </div>
        <div class="form-group">
          <?= form_input(array("type"=>"text", "name"=>"address", "id"=>"address", "class"=>"form-control input-lg alertable", "placeholder"=>"Address")); ?>
        </div>
        <div class="form-group">
          <?= form_button(array("name"=>"btn-save", "class"=>"btn btn-primary btn-lg btn-block", "id"=>"btn-save", "content"=>"save")); ?>
        </div>        
        <?= form_close(); ?>        
      </div>
    </div>
    <!-- random picker panel -->    
    <div class="panel panel-default">
      <div class="panel-body">
        <?= form_open(site_url("places/get_random"), array("name"=>"random-picker-form", "id"=>"random-picker-form")); ?>
        <div id="random-alerts-container">
        </div>  
        <div class="form-group">
          <?= form_button(array("name"=>"btn-random", "class"=>"btn btn-default btn-lg btn-block", "id"=>"btn-random", "content"=>"Pick a place")); ?>
        </div>         
        <?= form_close(); ?>
        <h4 class="place-title">You are going to:</h4>
        <div id="random-place">
          <h2 class="place-name" id="place-name"></h2>
          <h3 class="place-address" id="place-address"></h3>
          <div id="map-container"></div>
        </div>
      </div>
    </div>    
  </div>
  <!-- right area -->
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-body">
        <h3>Your places</h3>
        <div id="places-list-alerts-container">
        </div>   
        <ul class="list-group" id="places-list">
        <?php foreach ($my_places as $place): ?>
          <li class="list-group-item"><a href="#" class="place-link" data-id="<?= $place->id?>"><?= $place->name ?></a><i class="fa fa-times fa-2x pull-right remove-place" data-id="<?= $place->id?>" aria-hidden="true"></i></li>
        <?php endforeach ?>  
        </ul>  
      </div>
    </div>  
  </div>  
</div>