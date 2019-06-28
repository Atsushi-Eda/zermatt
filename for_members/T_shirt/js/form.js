$(function(){
  $('#buy input').change(function(){
    if($(this).val()=="1"){
      $(this).parent().parent().parent().nextAll('#size').addClass('required');
      $(this).parent().parent().parent().nextAll('#size').find('input').addClass("validate[required]");
    }else{
      $(this).parent().parent().parent().nextAll('#size').removeClass('required');
      $(this).parent().parent().parent().nextAll('#size').find('input').removeClass("validate[required]");
    }
  });
});