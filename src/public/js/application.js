$("#application").ready(function(){
  $("#my-profile").click(function(e){
    e.preventDefault();

    hideMessage("#profile-alerts-container");
    unboundErrors("#profile-form");
    $.ajax(
      base_url("users/get_current_user"),
        {
          method: "GET",
          dataType: "json",
          success: function(resp, status, req) {
            $("#first_name").val(resp.data.first_name);
            $("#last_name").val(resp.data.last_name);
            $("#email").val(resp.data.email);
            $("#city").val(resp.data.city);
            $("#password").val("");
            $("#repassword").val("");
          },
          error: function(req, status, error) {
            boundErrors(req.responseJSON.level, req.responseJSON.data);
            displayMessage("#profile-alerts-container", req.responseJSON.message, req.responseJSON.level, true);
          }
        } 
      ); 
  });
  $("#btn-save-profile").click(function(){
    $.ajax(
      base_url("users/save_current_user"),
        {
          method: "POST",
          data: $("#profile-form").serialize(),
          dataType: "json",
          success: function(resp, status, req) {
            unboundErrors("#profile-form");
            displayMessage("#profile-alerts-container", resp.message, resp.level, true);
          },
          error: function(req, status, error) {
            boundErrors("#profile-form", req.responseJSON.level, req.responseJSON.data, true);
            displayMessage("#profile-alerts-container", req.responseJSON.message, req.responseJSON.level, true);
          }
        } 
      );    
  });
});

$(".application.places.my_places").ready(function(){


  function savePlace() {
    $("#btn-save").prop("disabled", true);
    $.ajax(
      base_url("places/save"),
        {
          method: "POST",
          data: $("#save-form").serialize(),
          dataType: "json",
          success: function(resp, status, req) {
            unboundErrors("#save-form");
            displayMessage("#save-form-alerts-container", resp.message, resp.level, true);

            // Add element if is new
            var current_place_id = $("#current_place_id").val();
            if(current_place_id == "") {
              $("#places-list").prepend('<li class="list-group-item"><a href="#" data-id="'+resp.data.id+'">'+resp.data.name+'</a><i class="fa fa-times fa-2x pull-right" aria-hidden="true"></i></li>');
            } else {
              // Update element
              $(".place-link[data-id="+current_place_id+"]").text($("#name").val());
            }


            $("#btn-save").prop("disabled", false);
            clearPlace();
          },
          error: function(req, status, error) {
            boundErrors("#save-form", req.responseJSON.level, req.responseJSON.data, true);
            displayMessage("#save-form-alerts-container", req.responseJSON.message, req.responseJSON.level, true);
            $("#btn-save").prop("disabled", false);
          }
        } 
      );
  }
  function clearPlace() {
    $("#current_place_id").val("");
    $("#name").val("");
    $("#address").val("");
  }
  function loadPlace(id) {
    $.ajax(
      base_url("places/find/".concat(id)),
        {
          method: "GET",
          dataType: "json",
          success: function(resp, status, req) {
            // load place
            hideMessage("#save-form-alerts-container");
            unboundErrors("#save-form");
            $("#current_place_id").val(resp.data.id);
            $("#name").val(resp.data.name);
            $("#address").val(resp.data.address);
            $("#google_place_id").val(resp.data.google_place_id);
          },
          error: function(req, status, error) {
            displayMessage("#places-list-alerts-container", req.responseJSON.message, req.responseJSON.level, true);
          }
        } 
      );    
  }

  function removePlace(id) {
    $.ajax(
      base_url("places/remove/".concat(id)),
        {
          method: "GET",
          dataType: "json",
          success: function(resp, status, req) {
            // remove place
            hideMessage("#save-form-alerts-container");
            unboundErrors("#save-form");

            $(".place-link[data-id="+id+"]").parent().slideUp(400, function(){
              displayMessage("#places-list-alerts-container", resp.message, resp.level, true);  
            });
            
          },
          error: function(req, status, error) {
            displayMessage("#places-list-alerts-container", req.responseJSON.message, req.responseJSON.level, true);
          }
        } 
      );    
  }

  function getRandomPlace() {
    $.ajax(
      base_url("places/get_random/"),
        {
          method: "GET",
          dataType: "json",
          success: function(resp, status, req) {
            // remove place
            hideMessage("#save-form-alerts-container");
            hideMessage("#places-list-alerts-container");
            hideMessage("#random-alerts-container");
            unboundErrors("#save-form");
            geocodePlaceId(resp.data.google_place_id);
            $("#random-place").slideUp(400, function(){
                $("#place-name").text(resp.data.name);
                $("#place-address").text(resp.data.address);
                $(this).slideDown(400);
            });
          },
          error: function(req, status, error) {
            displayMessage("#random-alerts-container", req.responseJSON.message, req.responseJSON.level, true);
          }
        } 
      );    
  }


  $("#save-form").submit(function(e){
    e.preventDefault();
  });
  $("#btn-save").click(function(){
    savePlace();     
  });

  $(".place-link").click(function(e){
    e.preventDefault();
    loadPlace($(this).data("id"));
  });

  $(".remove-place").click(function(){
    removePlace($(this).data("id"));
  });

  $("#random-picker-form").submit(function(){
    e.preventDefault();
  });
  $("#btn-random").click(function(){
    getRandomPlace();
  })
});