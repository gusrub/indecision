$(".login.index").ready(function(){
  function doLogin(){
    $.ajax(
      base_url("login/do_login"),
        {
          method: "POST",
          data: $("#login-form").serialize(),
          dataType: "json",
          success: function(resp, status, req) {
            redirect("places/my_places");
          },
          error: function(req, status, error) {
            displayMessage("#alerts-container", req.responseJSON.message, req.responseJSON.level, true);
            boundErrors("#login-form", req.responseJSON.level, req.responseJSON.data, false);
          }
        } 
      ); 
  }
  $("#login-form").submit(function(e){
    e.preventDefault();
  })
  $("#btn-login").click(function(){
    doLogin();
  });
});

$(".login.forgot_password").ready(function(){
  function requestNewPassword(){
    $.ajax(
      base_url("login/request_new_password"),
        {
          method: "POST",
          data: $("#request-password-form").serialize(),
          dataType: "json",
          success: function(resp, status, req) {
            $("#msg-heading").slideUp();
            $(".dismissable").slideUp({
              duration: 400, 
              done: function() {
                displayMessage("#alerts-container", resp.message, resp.level, false);
            }});

          },
          error: function(req, status, error) {
            displayMessage("#alerts-container", req.responseJSON.message, req.responseJSON.level, true);
            boundErrors("#request-password-form", req.responseJSON.level, req.responseJSON.data, true);
          }
        } 
      ); 
  }
  $("#request-password-form").submit(function(e){
    e.preventDefault();
  })
  $("#btn-request").click(function(){
    requestNewPassword();
  });
});

$(".login.reset_password").ready(function(){
  function saveNewPassword() {
    $.ajax(
      base_url("login/save_new_password"),
        {
          method: "POST",
          data: $("#reset-password-form").serialize(),
          dataType: "json",
          success: function(resp, status, req) {
            $("#msg-heading").slideUp();
            $(".dismissable").slideUp({
              duration: 400, 
              done: function() {
                displayMessage("#alerts-container", resp.message, resp.level, false);
            }});

          },
          error: function(req, status, error) {
            boundErrors("#reset-password-form", req.responseJSON.level, req.responseJSON.data, true);
            displayMessage("#alerts-container", req.responseJSON.message, req.responseJSON.level, true);
          }
        } 
      );   
  }
  $("#reset-password-form").submit(function(e){
    e.preventDefault();
  })
  $("#btn-reset").click(function(){
    saveNewPassword();
  });
});