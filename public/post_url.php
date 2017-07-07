<?php 
	require_once("../includes/functions.php");
    $conn = connect_to_db();
    //var_dump($conn);

    $original_url = null;
    if($_POST) {
      //var_dump($_POST);
      $original_url = $_POST['original_url'];
      //var_dump($original_url);
      $result = insert_url($original_url);
      //var_dump($result);
      if(isset($result)) {
      	echo($result);
      }

    }
	mysqli_close($conn);
?>