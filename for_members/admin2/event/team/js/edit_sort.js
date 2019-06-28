function sortable(){
  $('.jquery-ui-sortable').sortable({
    connectWith: '.jquery-ui-sortable',
    sort: function(e, ui){
      past_member_box_positioning(ui.helper, e);
    },
    update: function(){
      $(this).find('input[name^="member"]').val($(this).parent().parent().data('team'));
      count();
      ng();
      sort();
    }
  });
  $('.jquery-ui-sortable').disableSelection();
}
function sort(){
  $('.team_members').each(function(){
    $(this).html(
      $(this).children().sort(function(a, b) {
        if($(a).data('grade') > $(b).data('grade')){
          return 1;
        }else if($(a).data('grade') < $(b).data('grade')){
          return -1;
        }else{
          if($(a).data('gender') < $(b).data('gender')){
            return 1;
          }else if($(a).data('gender') > $(b).data('gender')){
            return -1;
          }else{
            if($(a).data('member') > $(b).data('member')){
              return 1;
            }else{
              return -1;
            }
          }
        }
      })
    );
  });
  $('.team_member').hover(function(e){
    past_member_box_positioning($(this), e);
  });
}