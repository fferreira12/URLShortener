<?php
  function connect_to_db() {
    $dbhost = "localhost";
    $dbuser = "urlshortener";
    $dbpass = "shorty";
    $dbname = "urlshortener";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    return $connection;
  }

  function save_cookie_last_url ($url, $id) {
    setcookie("last_url", $url, time() + (7*24*60*60));
    setcookie("last_id", $id, time() + (7*24*60*60));
  }

  function read_cookie_last_url() {
    if(isset($_COOKIE["last_url"]) && isset($_COOKIE["last_id"])) {
      return array($_COOKIE["last_url"], $_COOKIE["last_id"]);
    } else {
      return null;
    }
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
      $id = mysqli_insert_id($conn);
      save_cookie_last_url($url, $id);
      return $id;
    } else {
      $query = "SELECT `id` FROM `url` WHERE `original_url` = '{$url}';";
      $result = mysqli_query($conn, $query); 
      if($result) {
        $id = mysqli_fetch_row($result)[0];
        save_cookie_last_url($url, $id);
        return $id;
      } else {
        return null;
      }
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
