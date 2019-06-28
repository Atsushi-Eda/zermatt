function count(){
  count_team_box();
  count_table();
}
function count_team_box(){
  $.each($('.team'), function(i, val){
    $(val).find('.count').html($(val).find('.team_member').length);
    $(val).find('.count_male').html($(val).find('.male').length);
    $(val).find('.count_female').html($(val).find('.female').length);
  });
}
function count_table(){
  var grade_cls = [
    '',
    '.grade0',
    '.grade1',
    '.grade2',
    '.grade3',
  ];
  var gender_cls = [
    '',
    '.male',
    '.female',
  ];
  for(var team=0; team<teams; team++){
    for(var grade=0; grade<5; grade++){
      for(var gender=0; gender<3; gender++){
        $('.count_table_team' + team + ' .count_table_grade' + grade + '.count_table_gender' + gender).html($('#team' + team + ' .team_member' + grade_cls[grade] + gender_cls[gender]).length);
      }
    }
  }
}