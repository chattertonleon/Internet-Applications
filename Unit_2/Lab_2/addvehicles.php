<?php
  $veh_reg = $_REQUEST["veh_reg"];
  $veh_brand = $_REQUEST["veh_brand"];
  $day_rate = $_REQUEST["day_rate"];
  $radio_val = $_POST["radios"];

  function validateInputNonNumeric($input){
    if (!isset($input) || empty($input)){
        echo $input." IS FALSE YA NON NUMERIC BASTARD<br>";
      return false;
    }
    return true;
  }

  function validateInputNumeric($input){
    if (!validateInputNonNumeric($input) || !is_numeric($input)){
      echo $input." IS FALSE YA NUMERIC BASTARD<br>";
      return false;
    }
    return true;
  }

  function addQuotes($input){
    return "'".$input."'";
  }

  if (validateInputNonNumeric($veh_reg) && validateInputNonNumeric($veh_brand)
  && validateInputNumeric($day_rate)){
    require("connectdb.php");
    echo "<p>".$veh_reg." ".$veh_brand." ".$day_rate." ".$radio_val."</p>";
    try{
      $veh_reg = addQuotes($veh_reg);
      $veh_brand = addQuotes($veh_brand);
      $day_rate = addQuotes($day_rate);
      $radio_val = addQuotes($radio_val);
      $rowNum = $db->exec("INSERT INTO vehicles(reg_no, category, brand, dailyrate) VALUES(
      $veh_reg, $radio_val, $veh_brand, $day_rate)");
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      require("listvehicles.php");
    } catch (PDOException $ex) {
      echo "<p>Sorry, a database error occurred. Please try again.</p>";
      echo "<p>(Error details:".$ex->getMessage().")</p>";
    }
  }
?>
