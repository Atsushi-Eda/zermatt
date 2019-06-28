$(function() {
  $('#name').autocomplete({
    source : function(request, response) {
      r = r2h(request.term);
      var re = new RegExp('^(' + r + ')'), list = [];
      $.each(memberList, function(i, values) {
        if(values[0].match(re) || values[1].match(re)) {
          list.push(values[0]);
        }
      });
      response(list);
    }
  });
});