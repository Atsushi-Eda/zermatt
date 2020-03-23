$(function(){
  $('#img_button').on('change', function(e) {
    $('#album_imgs').empty();
    [].forEach.call(e.target.files, function(file){
      var reader = new FileReader();
      $(reader).on('load', function(read){
        $("<img>", {
          src: read.target.result,
          class: 'album_img',
        }).appendTo('#album_imgs');
      });
      reader.readAsDataURL(file);
    });
  });
});
