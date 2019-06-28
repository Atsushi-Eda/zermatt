function uniqueID(id){
  $("#video_id").val(new Date().getTime().toString(16) + Math.floor(1000*Math.random()).toString(16));
}
$(function(){
  $('form').on('change', 'input[type="file"]', function(e) {
    $("#trim").css("display","inline-block");
    $("#retrim").hide();
    var file = e.target.files[0],
      reader = new FileReader(),
      t = this;
    if(file.type.indexOf("image") < 0){
      return false;
    }
    reader.onload = (function(file) {
      return function(e) {
        $("#cropper").empty();
        $("#cropper").show();
        $("#cropper").append($('<img>').attr({
          src: e.target.result,
        }));
        var $image = $('#cropper > img'),replaced;
        $('#cropper > img').cropper({
          aspectRatio: 4 / 4,
          preview: '#member_img'
        });
      };
    })(file);
    reader.readAsDataURL(file);
  });
  $("#trim").click(function(){
    $(this).hide();
    $("#retrim").css("display","inline-block");
    $("#cropper").hide();
    var data = $('#cropper > img').cropper('getData');
    $("#cropper_x").val(Math.round(data.x));
    $("#cropper_y").val(Math.round(data.y));
    $("#cropper_width").val(Math.round(data.width));
    $("#cropper_height").val(Math.round(data.height));
  });
  $("#retrim").click(function(){
    $(this).hide();
    $("#trim").css("display","inline-block");
    $("#cropper").show();
  });
});