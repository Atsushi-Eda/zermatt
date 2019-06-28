$(function(){
  $("#form").validationEngine();
  $(".form_content.required input").addClass("validate[required]");
  $('.validation_trigger input').change(function(){
    if($(this).val()=="1"){
      $(this).parent().parent().parent().nextAll('.validation_change').addClass('required');
      $(this).parent().parent().parent().nextAll('.validation_change').find('input').addClass("validate[required]");
    }else{
      $(this).parent().parent().parent().nextAll('.validation_change').removeClass('required');
      $(this).parent().parent().parent().nextAll('.validation_change').find('input').removeClass("validate[required]");
    }
  });
});