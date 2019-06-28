function add_team_box(){
  var html;
  html = `
    <div id="team` + teams + `" data-team="` + teams + `" class="team assigned box">
      <div class="team_header">
        <h3>` + teams + `班</h3>
        <div class="counts"><span class="count"></span>(<span class="count_male"></span>,<span class="count_female"></span>)</div>
      </div>
      <div class="team_content">
        <ul class="team_members jquery-ui-sortable">
        </ul>
      </div>
    </div>
  `;
  $('#teams').append(html);
}
function add_table(){
  var html;
  html = `
    <tr class="count_table_team` + teams + `">
      <td>` + teams + `</td>
  `;
  for(var grade=0; grade<5; grade++){
    for(var gender=0; gender<3; gender++){
      html += `<td class="count_table_grade` + grade + ` count_table_gender` + gender + `"></td>`;
    }
  }
  html += `</tr>`;
  $('table').append(html);
}