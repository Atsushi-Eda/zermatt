$(function(){
  $('#img_button').on('change', function(e) {
    $('#event_imgs').empty();
    [].forEach.call(e.target.files, function(file){
      var reader = new FileReader();
      $(reader).on('load', function(read){
        $("<img>", {
          src: read.target.result,
          class: 'event_img',
        }).appendTo('#event_imgs');
      });
      reader.readAsDataURL(file);
    });
  });
});
