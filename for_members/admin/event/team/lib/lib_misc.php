<?php
function grade_type($grade){
  if($grade == MANAGER_GRADE) return "grade0";
  elseif($grade < MANAGER_GRADE) return "grade1";
  elseif($grade == MANAGER_GRADE+1) return "grade2";
  else return "grade3";
}