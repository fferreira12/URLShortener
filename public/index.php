<?php
require_once("../includes/functions.php");
//global connection
$conn = connect_to_db();

//redirect to original url if there is a u parameter in a GET URL
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
  <script src="javascripts/jquery-3.2.1.min.js"></script>
  <script src="javascripts/script.js"></script>
</head>
<body>
  <div id="central" class="central">
    <h1 id="mainTitle">URL Shortener</h1>
    <?php
      // if(isset($not_found)) {
      //   echo "<p class=\"info\">The url requested was not found. Try creating it below</p>";
      // }
    ?>
    <form id="form"> <!-- action="include_url.php" method="post" -->
      <input class="wideTxtBox" type="text" id = "originalUrl" name="original_url" placeholder="Type a URL to make it shorter:">
    </br>
      <input class="wideBtn" type="button" name="submit" value="Shorten it" onclick="postNewUrlAJAX();">
    </form>

    <?php 
      $last = read_cookie_last_url();
      if(isset($last)) {
        echo "<p class=\"info\" id='lastUrl'>The last URL you shortened was {$last[0]}. <br/> The shortened URL is <a href=\"http://localhost/URLShortener/public?u={$last[1]}\">http://localhost/URLShortener/public?u={$last[1]}</a>";
      }
    ?>

  </div>

</body>
</html>
<?php
  mysqli_close($conn);
?>
