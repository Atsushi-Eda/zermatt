function duplicationCheck(){
  var values = $('.noDuplication').map(function(){return $(this).val()});
  var uniqueValues = $.extend(true, {}, values);
  $.unique(uniqueValues);
  if(values.length !== uniqueValues.length){
    alert("順位の重複があります。");
    return false;
  }
}