function assign_all(){
  if($('.team').length > 1){
    while($('#team0 .team_member').length > 0){
      assign();
    }
  }
}
function assign(){
  var target = assign_chose();
  var analysis = assign_analyze(target);
  var move_places = assign_find_move_places(analysis);
  var move_place = assign_chose_move_place(move_places);
  $(target).find('input[name^="member"]').val($(move_place).parent().parent().data('team'));
  $(target).appendTo(move_place);
}
function assign_chose(){
  var count = $('#team0 .team_member').length;
  var rand = Math.floor(Math.random() * count);
  return $('#team0 .team_member')[rand];
}
function assign_analyze(target){
  var analyze = {
    gender : $(target).data("gender"),
    grade : $(target).data("grade")
  };
  return analyze;
}
function assign_find_move_places(analysis){
  var min;
  var move_places = [];
  var cls = '.' + analysis.gender + '.' + analysis.grade;
  $.each($('.assigned .team_members'), function(i, val){
    if(min > $(val).find(cls).length || i == 0){
      min = $(val).find(cls).length;
    }
  });
  $.each($('.assigned .team_members'), function(i, val){
    if(min == $(val).find(cls).length){
      move_places.push(val);
    }
  });
  return move_places;
}
function assign_chose_move_place(move_places){
  var count = move_places.length;
  var rand = Math.floor(Math.random() * count);
  return move_places[rand];
}