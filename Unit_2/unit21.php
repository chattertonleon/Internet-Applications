<!DOCTYPE html>
<html>
<head>
  <title>Unit2-1 Basic PHP Programing - Tasks </title>
</head>

<body>
	<h1>Unit2-1 tasks</h1>

	<!-- Task 1: String-->
	<!-- write your solution to Task 1 here -->
	<div class="section">
		<h2>Task 1 : String</h2>
    <?php
      $text = 'I love programming';
      echo '<p>'.$text.'</p>';
      echo '<p>'.$text[0].'</p>';
      echo '<p>'.strlen($text).'</p>';
      echo '<p>'.$text[strlen($text)-1].'</p>';
      echo '<p>'.substr($text, 0, 6).'</p>';
      echo '<p>'.ucwords($text).'</p>';
    ?>
	</div>

	<!-- Task 2: Array and image-->
	<!-- write your solution to Task 2 here -->
	<div class="section">
		<h2>Task 2 : Array and image</h2>
    <?php
      define('IMAGES','images/');
      $imgArray = array("earth.jpg", "flower.jpg", "plane.jpg", "tiger.jpg");
      echo '<img src="'.IMAGES.$imgArray[rand(0,3)].'">';
      echo '<img src="'.IMAGES.$imgArray[rand(0,3)].'">';
      echo '<img src="'.IMAGES.$imgArray[rand(0,3)].'">';
      echo '<img src="'.IMAGES.$imgArray[rand(0,3)].'">';
    ?>
  </div>

	<!-- Task 3: Function definition dayinmonth  -->
	<!-- write your solution to Task 3 here -->
	<div class="section">
		<h2>Task 3 : Function definition</h2>
    <?php
      function dayinmonth($monthNum){
        $yearArray = array(31,28,31,30,31,30,31,31,30,31,30,31);
        return $yearArray[$monthNum-1];
      }
      echo '<p>'.dayinMonth(6).'</p>';
    ?>
	</div>



	<!-- Task 4: Favorite Artists from a File (Files) -->
	<!-- write your solution to Task 4 here -->
	<div class="section">
		<h2>Task 4: My Favorite Artists from a file</h2>
    <?php
      $read_file = file('favorite.txt');
      foreach ($read_file as $celebName){
        echo '<p><a href="https://www.mtv.com/artists/'.$celebName.'/">'.$celebName.'</a></p>';
      }
    ?>
	</div>

	<!-- Task 6: Directory operations -->
	<!-- write your solution to Task 6 here -->
	<div class="section">
		<h2>Task 6 : Directory operations</h2>



	</div>

	<!-- Task 6 optional: Directory operations -->
	<!-- write your solution to Task 6 optional here -->
	<div class="section">
		<h2>Task 6 optional: Directory operations optional</h2>



	</div>
	</div



    <!-- Task 5: including external files -->
	<!-- write your solution to Task 5 here -->
	<div class="section">
		<h2>Task 5: including external files</h2>


	</div>

</body>
</html>
