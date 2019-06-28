function return_not_assigned(){
  $.each($('.assigned .team_member'), function(i, val){
    $(val).find('input[name^="member"]').val('');
    $(val).appendTo('#team0 .team_members');
  });
}