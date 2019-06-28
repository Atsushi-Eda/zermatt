$(function(){
  $("#menu-trigger").click(function(){
    $("#menu").toggleClass("active");
  });
  $("#menu a").click(function(){
    $("#menu").removeClass("active");
  });
});