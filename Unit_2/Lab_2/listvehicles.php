<?php
  require("connectdb.php");
  $rows = $db->query("SELECT * FROM vehicles");
  echo "<table>";
  echo "<tr>";
  echo "<th>Reg No</th><th>Category</th><th>Brand</th><th>Description</th><th>Daily Rate</th>";
  echo "</tr>";
  foreach ($rows as $row) {
    echo "<tr>";
    $skip = false;
    foreach ($row as $elem){
      if ($skip){
        echo "<td>".$elem."</td>";
      }
      $skip = !$skip;
    }
    echo "</tr>";
  }
  echo "</table>";
?>
