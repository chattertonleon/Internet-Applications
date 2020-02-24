<?php
  try{
    $db = new PDO("mysql:dbname=carent;host=localhost","root","");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch (PDOException $ex){
    echo "<p>Sorry, a database error occurred. Please try again.</p>";
    echo "<p>(Error details: <?= $ex->getMessage() ?>)</p>";
  }
?>
