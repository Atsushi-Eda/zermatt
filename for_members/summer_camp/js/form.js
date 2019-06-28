$(function(){
  $('#participation input').change(function(){
    $(this).parent().parent().parent().nextAll('#private_car_flag').removeClass('required');
    $(this).parent().parent().parent().nextAll('#private_car_flag').find('input').removeClass("validate[required]");
    $(this).parent().parent().parent().nextAll('#private_car').removeClass('required');
    $(this).parent().parent().parent().nextAll('#private_car').find('input').removeClass("validate[required]");
    $(this).parent().parent().parent().nextAll('#car_rental').removeClass('required');
    $(this).parent().parent().parent().nextAll('#car_rental').find('input').removeClass("validate[required]");
    $(this).parent().parent().parent().nextAll('#racket').removeClass('required');
    $(this).parent().parent().parent().nextAll('#racket').find('input').removeClass("validate[required]");
    $(this).parent().parent().parent().nextAll('#ball').removeClass('required');
    $(this).parent().parent().parent().nextAll('#ball').find('input').removeClass("validate[required]");
    $(this).parent().parent().parent().nextAll('#date').removeClass('required');
    $(this).parent().parent().parent().nextAll('#date').find('input').removeClass("validate[required]");
    $(this).parent().parent().parent().nextAll('#note').removeClass('required');
    $(this).parent().parent().parent().nextAll('#note').find('textarea').removeClass("validate[required]");
    $(this).parent().parent().parent().nextAll('#note').removeClass('free');
    $(this).parent().parent().parent().nextAll('#note').removeClass('absent');
    $(this).parent().parent().parent().nextAll('#note').removeClass('undecided');
    if($(this).val()=="1"){
      $(this).parent().parent().parent().nextAll('#private_car_flag').addClass('required');
      $(this).parent().parent().parent().nextAll('#private_car_flag').find('input').addClass("validate[required]");
      $(this).parent().parent().parent().nextAll('#racket').addClass('required');
      $(this).parent().parent().parent().nextAll('#racket').find('input').addClass("validate[required]");
      $(this).parent().parent().parent().nextAll('#ball').addClass('required');
      $(this).parent().parent().parent().nextAll('#ball').find('input').addClass("validate[required]");
      $(this).parent().parent().parent().nextAll('#note').addClass('free');
      if($("#private_car_flag input:checked").val()=="1"){
        $(this).parent().parent().parent().nextAll('#private_car').addClass('required');
        $(this).parent().parent().parent().nextAll('#private_car').find('input').addClass("validate[required]");
      }else if($("#private_car_flag input:checked").val()=="0"){
        $(this).parent().parent().parent().nextAll('#car_rental').addClass('required');
        $(this).parent().parent().parent().nextAll('#car_rental').find('input').addClass("validate[required]");
      }
    }else if($(this).val()=="2"){
      $(this).parent().parent().parent().nextAll('#date').addClass('required');
      $(this).parent().parent().parent().nextAll('#date').find('input').addClass("validate[required]");
      $(this).parent().parent().parent().nextAll('#note').addClass('free');
    }else if($(this).val()=="3"){
      $(this).parent().parent().parent().nextAll('#note').addClass('required');
      $(this).parent().parent().parent().nextAll('#note').find('textarea').addClass("validate[required]");
      $(this).parent().parent().parent().nextAll('#note').addClass('absent');
    }else{
      $(this).parent().parent().parent().nextAll('#note').addClass('required');
      $(this).parent().parent().parent().nextAll('#note').find('textarea').addClass("validate[required]");
      $(this).parent().parent().parent().nextAll('#note').addClass('undecided');
    }
  });
  $('#private_car_flag input').change(function(){
    $(this).parent().parent().parent().nextAll('#private_car').removeClass('required');
    $(this).parent().parent().parent().nextAll('#private_car').find('input').removeClass("validate[required]");
    $(this).parent().parent().parent().nextAll('#car_rental').removeClass('required');
    $(this).parent().parent().parent().nextAll('#car_rental').find('input').removeClass("validate[required]");
    if($(this).val()=="1"){
      $(this).parent().parent().parent().nextAll('#private_car').addClass('required');
      $(this).parent().parent().parent().nextAll('#private_car').find('input').addClass("validate[required]");
    }else{
      $(this).parent().parent().parent().nextAll('#car_rental').addClass('required');
      $(this).parent().parent().parent().nextAll('#car_rental').find('input').addClass("validate[required]");
    }
  });
});