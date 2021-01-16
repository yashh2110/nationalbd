$(document).ready(function(){
  $("#src").on("keyup",function(){
    var value = $(this).val().toLowerCase();
    $(".filter").filter(function(){
      var match =$(this).parent();
      match.toggle($(this).text().toLowerCase().indexOf(value)>-1);
    });
  });
$(".barlogout").click(function(){
  $(".usernamecard").toggle(200);
});
$(document).click(function(e){
  if($(e.target).closest(".usernamecard,.barlogout").length==0){
    $(".usernamecard").hide(200);
  }
})
});
