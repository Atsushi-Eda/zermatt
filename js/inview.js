$(function(){
  $('.inview').on('inview', function(event, isInView, visiblePartX, visiblePartY) {
    if(isInView){
      $(this).stop().addClass('active');
    }
    else{
      $(this).stop().removeClass('active');
    }
  });
});