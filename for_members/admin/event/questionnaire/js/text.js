$(function(){
  $(".button").click(function(){
    $("#textarea").select();
    document.execCommand("copy");
    window.alert("クリップボードにコピーしました。")
  });
});