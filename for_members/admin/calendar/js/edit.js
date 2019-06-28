function delete_confirm(id){
  if(window.confirm("日程を取り消します。\nよろしいですか?")){
    location.href = "delete.php?id=" + id;
  }
}