<?php
require_once("../includes/functions.php");
//global connection
$conn = connect_to_db();

if($_GET && isset($_GET['u'])) {
  $url = get_original_url($_GET['u']);
  if(!is_null($url)) {
    header('Location: '.$url);
    die();
  } else {
    $not_found = $_GET['u'];
  }

}

?>

<!DOCTYPE HTML>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="stylesheets/styles.css">
</head>
<body>
  <div class="central">
    <h1>URL Shortener</h1>
    <?php
      if(isset($not_found)) {
        echo "<p class=\"info\">The url requested was not found. Try creating it below</p>";
      }
    ?>
    <form action="include_url.php" method="post">
      <input class="wideTxtBox" type="text" name="original_url" placeholder="Type a URL to make it shorter:">
    </br>
      <input class="wideBtn" type="submit" name="submit" value="Shorten it">
    </form>
  </div>

</body>
</html>
<?php
  mysqli_close($conn);
?>
