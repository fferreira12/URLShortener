<!DOCTYPE HTML>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="stylesheets/styles.css">
</head>
<body>

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

    }
  ?>

  <div class="central">
    <h1><?php
      if($result) {
        echo "Sucess!";
      } else {
        echo "Something's wrong...";
      }
    ?></h1>
    <p><?php
      if(!is_null($result)) {
        $short = "http://localhost/urlshortener/public?u=" . $result;
        echo "Your shortened URL is: <a href=' {$short}'" . ">" . "{$short}" . "</a>";
      } else {
        echo "We couldn't shorten your url :/";
      }
    ?></p>

  </div>


</body>
</html>
<?php mysqli_close($conn); ?>