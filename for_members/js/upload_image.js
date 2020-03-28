$(function(){
  $('#upload_image_button').on('change', function(e) {
    $('#upload_image_wrapper').empty();
    [].forEach.call(e.target.files, function(file){
      var reader = new FileReader();
      $(reader).on('load', function(read){
        $("<img>", {
          src: read.target.result,
          class: 'upload_image',
        }).appendTo('#upload_image_wrapper');
      });
      reader.readAsDataURL(file);
    });
  });
});
