$(function(){
  $(".arrows span").click(function(){
    $("html,body").animate({scrollTop: $("#home").position().top}, 'slow');
  });
  if(!$(this).scrollTop()){
    $(".arrows-wrap").css('position', 'fixed');
  }
  $(window).scroll(function(){
    if($(this).scrollTop()){
      $(".arrows-wrap").css('position', 'absolute');
    }else{
      $(".arrows-wrap").css('position', 'fixed');
    }
  });
  function backgroundSlide(){
    $('#background img:first-child').clone().appendTo('#background');
    $('#background img:first-child').animate({
      'margin-top': -$('#background img:first-child').height()
    }, 3000, function(){
      $('#background img:first-child').remove();
      backgroundSlide();
    });
  }
  backgroundSlide();
  $("#mv_slide").slick({
    arrows: false,
    autoplay: true,
    autoplaySpeed: 3000,
    speed: 500,
    pauseOnHover:false,
    fade: true,
    cssEase: 'linear'
  });
  function resizeMV(){
    var flame = $("#mv_slide");
    var imgs = $("#mv_slide img");
    $.each(imgs,function(){
      var img = new Image();
      img.src = $(this).attr('src');
      var rh = flame.height() / img.height;
      var rw = flame.width() / img.width;
      if(rw > rh){
        $(this).css({
          "width": "100%",
          "height": img.height * rw + "px",
          "margin-top": -1 * (img.height * rw - flame.height()) / 2 + "px",
          "margin-left": 0
        });
        if($(this).hasClass("trim_top")){
          $(this).css({
            "margin-top": -1 * (img.height * rw - flame.height()) + "px",
          });
        }
        if($(this).hasClass("trim_bottom")){
          $(this).css({
            "margin-top": 0,
          });
        }
      }else{
        $(this).css({
          "height": "100vh",
          "width": img.width * rh + "px",
          "margin-left": -1 * (img.width * rh - flame.width()) / 2 + "px",
          "margin-top": 0
        });
      }
    });
  }
  var allImage = $("#mainvisual img");
  for(var i = 0; i < allImage.length; i++){
    $(allImage[i]).imagesLoaded(function(){
      resizeMV();
    });
  }
  $(window).resize(function(){
    resizeMV();
  });
});