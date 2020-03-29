$(function(){
  $('.filter_date').on('change', function(e){
    var filename = location.href.match(".+/(.+?)([\?#;].*)?$")[1];
    location.href = (filename.indexOf('.') !== -1 ? filename : './') + '?filter_date=' + e.target.value;
  });
});
