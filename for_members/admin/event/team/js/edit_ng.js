function ng(){
  var team_member_list = [];
  $('.team_member').removeClass('error0');
  $('.team_member').removeClass('error1');
  $('.past_member').removeClass('error0');
  $('.past_member').removeClass('error1');
  $.each($('.team'), function(i, team){
    team_member_list = ng_make_team_member_list(team);
    ng_check_past_team_member(team, team_member_list);
  });
}
function ng_make_team_member_list(team){
  var team_member_list = [];
  $.each($(team).find('.team_member'), function(i, team_member){
    team_member_list[i] = $(team_member).data('member');
  });
  return team_member_list;
}
function ng_check_past_team_member(team, team_member_list){
  var team_member_id, past_member_id;
  $.each($(team).find('.team_member'), function(i, team_member){
    team_member_id = $(team_member).data('member');
    for(j=0;j<=1;j++){
      $.each($(team_member).find('.past_event' + j).find('.past_member'), function(k, past_member){
        past_member_id = $(past_member).data('member');
        if(team_member_id != past_member_id && $.inArray(past_member_id, team_member_list) >= 0){
          $(team_member).addClass('error' + j);
          $(past_member).addClass('error' + j);
        }
      });
    }
  });
}
function past_member_box_positioning(team_member, e){
  if(e.pageX < window.innerWidth/2){
    $('.past').css({
      'top': (team_member.offset().top - $(window).scrollTop() - 200) + 'px',
      'left': (team_member.offset().left - $(window).scrollLeft() + 120) + 'px',
    });
  }else{
    $('.past').css({
      'top': (team_member.offset().top - $(window).scrollTop() - 200) + 'px',
      'left': (team_member.offset().left - $(window).scrollLeft() - 150) + 'px',
    });
  }
}