<?php
  $input1 = $_REQUEST["input1"];
  $input2 = $_REQUEST["input2"];

  function checkDivBy0($input1, $input2)
  {
    if ($input1 == 0 || $input2 == 0) {
      return false;
    }
    return true;
  }

  function getAdd($input1, $input2)
  {
    return $input1 + $input2;
  }

  function getMinus($input1,$input2)
  {
    return $input1 - $input2;
  }

  function getMult($input1,$input2)
  {
    return $input1 * $input2;
  }

  function getDivision($input1,$input2)
  {
    return $input1 / $input2;
  }

  echo "<p>Your first input: ".$input1."</p>";
  echo "<p>Your second input: ".$input2."</p>";
  echo "<p>Addition result: ".getAdd($input1,$input2)."</p>";
  echo "<p>Subtraction result: ".getMinus($input1,$input2)."</p>";
  echo "<p>Multiplication result: ".getMult($input1,$input2)."</p>";
  if (!checkDivBy0($input1,$input2)){
    echo "<p>Division by zero, please edit inputs</p>";
  }
  else{
    echo "<p>Divison result: ".getDivision($input1,$input2)."</p>";
  }
?>
