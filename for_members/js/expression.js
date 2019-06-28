$(function(){
  $('.expression input').change(function(){
    if($(this).val()=="1"){
      $(this).parent().parent().removeClass('cry');
      $(this).parent().parent().addClass('smile');
    }else{
      $(this).parent().parent().removeClass('smile');
      $(this).parent().parent().addClass('cry');
    }
  });
});