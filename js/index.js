function seePassword(){
  var see = document.getElementById("pass");
  var rsee = document.getElementById("rpass");
  if(see.type === "password"){
    see.type = "text";
  }else{
    see.type = "password";
  }
  if(rsee.type === "password"){
    rsee.type = "text";
  }else{
    rsee.type = "password";
  }
}
$(document).ready(function(){
  $("#eye").click(function(){
    $("#eye1").show();
    $(this).hide();

  });
  $("#eye1").click(function(){
    $(this).hide();
    $("#eye").show();
  });

});
