$(function(){
  $(".slide").slick({
    arrows: false,
    autoplay: true,
    autoplaySpeed: 3000,
    speed: 500,
    pauseOnHover:false,
    fade: true,
    cssEase: 'linear'
  });
/*  $(".pop_trigger").click(function(){
    $(this).parent().nextAll(".pop_wrap").css("display", "block");
  });
  $(".close").click(function(){
    $(".pop_wrap").css("display", "none");
    videoControl("pauseVideo");
  });
  function videoControl(action){
    $.each($('.player'), function(i, val) {
    var $playerWindow = val.contentWindow;
      $playerWindow.postMessage('{"event":"command","func":"'+action+'","args":""}', '*');
    });
  }*/
});