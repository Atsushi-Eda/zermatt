//ラジオボタンにしか対応してません。
$(function(){
  $("#required_cnt1").html($(".required").length);
  $("#required_cnt2").html($(".required input:checked").length);
  $('.validation_trigger input').change(function(){
    $("#required_cnt1").html($(".required").length);
  });
  $('input').change(function(){
    $("#required_cnt2").html($(".required input:checked").length);
    if($(".required").length == $(".required input:checked").length){
      $("#required_cnt_wrap p:eq(1)").css("color", "#00f");
    }else{
      $("#required_cnt_wrap p:eq(1)").css("color", "#000");
    }
  });
});