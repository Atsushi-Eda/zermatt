$(document).ready(function(){
  $("#name").keyup(function(){
    $('#name').autocomplete({source:''});
    var serch_term = $("#name").val();
    if(serch_term != ""){
      $.ajax({
        type: "POST",
        url: "inc/autocomplete.php",
        data: {
          "search": serch_term
        },
        success : function(j_data){
          $('#name').autocomplete({
            source : function(request, response){
              response(j_data);
            }
          });
        }
      });
    }
  });
});