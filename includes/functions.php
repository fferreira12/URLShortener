<?php
  function connect_to_db() {
    $dbhost = "localhost";
    $dbuser = "urlshortener";
    $dbpass = "shorty";
    $dbname = "urlshortener";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    return $connection;
  }

  // function get_next_short() {
  //   //to be improved
  //   return (string) time();
  // }

  function insert_url($url) {
    global $conn;
    //var_dump($conn);
    //$short = get_next_short();
    //var_dump($short);
    $query = "INSERT INTO `url` (`original_url`) VALUES ('{$url}');";
    //echo $query;
    $result = mysqli_query($conn, $query);
    //var_dump($result);
    if($result) {
      return mysqli_insert_id($conn);
    } else {
      return null;
    }
  }

  function get_original_url($short_string) {
    global $conn;
    $query  = "SELECT original_url FROM `url` ";
    $query .= "WHERE id = '{$short_string}';";
    //echo $query;
    $result = mysqli_query($conn, $query);
    if(!$result) {
      //die("db query failed");
      return null;
    } elseif (mysqli_num_rows($result) == 0) {
      return null;
    } else {
      return mysqli_fetch_row($result)[0];
    }

  }


?>
