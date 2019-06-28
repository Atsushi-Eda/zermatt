$(function(){
  $('#teams').on("dblclick dblTap", ".team_member", function(){
    $(this).toggleClass('team_leader');
    $(this).find('input[name^="leader"]').val($(this).find('input[name^="leader"]').val() ^ 1);
  });
  $('#teams').on("mousedown", ".team_member", function(){
    $(this).addClass('active');
  });
  $('#teams').on("mouseup", ".team_member", function(){
    $(this).removeClass('active');
  });
  $('#is_sortable').change(function(){
    $('.jquery-ui-sortable').sortable($(this).prop("checked") ? 'enable': 'disable');
  });
  $('#return').click(function(){
    return_not_assigned();
    count();
    ng();
    sort();
  });
  $('#assign').click(function(){
    assign_all();
    count();
    ng();
    sort();
  });
  $('#add').click(function(){
    add_team_box();
    add_table();
    sortable();
    teams++;
    count();
  });
  sortable();
  count();
  ng();
  sort();
});