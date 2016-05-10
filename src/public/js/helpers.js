function displayMessage(tgt, msg, type, dismissable) {
  hideMessage(tgt, function(){
    $(tgt).empty();
    if (dismissable) {
      $(tgt).append('<div class="alert alert-'+type+' alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+msg+'</div>');    
    } else {
      $(tgt).append('<div class="alert alert-'+type+'" role="alert">'+msg+'</div>')
    };
    $(tgt).slideDown(400); 
  }); 
}
function hideMessage(tgt, callback) {
  $(tgt).slideUp(400, callback);
}
function unboundErrors(parent) {
  $(parent.concat(" .alertable")).parent().removeClass("has-error has-warning has-success");
  $(parent.concat(" .success, .warning, .info, .error")).remove();
}
function boundErrors(elem, level, errors, displayDetail) {
  unboundErrors(elem);
  $.each(errors, function(i, e){
    $("#".concat(i)).parent().addClass("has-".concat(level));

    if(displayDetail) {
      $("#".concat(i)).after("<span id='"+i+"' class='"+level+"'>"+e+"</span>");
    }
  });
}

function redirect(path) {
  window.location = base_url(path);
}

function base_url(path) {
  return BASE_URL.concat(path);
}