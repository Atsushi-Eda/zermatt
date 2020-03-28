$(function(){
  $("#move_date").click(function(){
    location.href = location.href.match(".+/(.+?)([\?#;].*)?$")[1]+'?date='+$("#year").val()+"-"+('0'+$("#month").val()).slice(-2)+"-"+('0'+$("#day").val()).slice(-2);
  });
});
