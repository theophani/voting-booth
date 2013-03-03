<?php
  require_once('../db-config.php');

  function has_already_voted($voter) {
    global $database_egatetif, $egatetif;

    mysql_select_db($database_egatetif, $egatetif);
    $query = "SELECT * FROM hackathon_voters WHERE code = '" . $voter . "'";
    $voters = mysql_query($query, $egatetif) or die(mysql_error());
    $row = mysql_fetch_assoc($voters);
    return $row['voted'];
  }

  function is_allowed_to_vote ($voter) {
    global $database_egatetif, $egatetif;

    mysql_select_db($database_egatetif, $egatetif);
    $query = "SELECT * FROM hackathon_voters WHERE code = '" . $voter . "'";
    $voters = mysql_query($query, $egatetif) or die(mysql_error());
    $row = mysql_fetch_assoc($voters);
    return !!$row;
  }

  function redirect_to_ballot($voter) {
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $params = '?voter=' . $voter;
    header("Location: http://$host$uri/$params");
  }

  function record_vote($voter, $votes) {
    global $database_egatetif, $egatetif;
    mysql_select_db($database_egatetif, $egatetif);

    if (!has_already_voted($voter)) {
      foreach ($votes as $key => $value) {
        $query = "INSERT INTO `hackathon_votes` ( `project_id` ,  `voter_code` )  VALUES ('".$value."',  '".$voter."')";
        mysql_query($query, $egatetif) or die(mysql_error());
      }

      $query = "UPDATE `hackathon_voters` SET `voted` =  '1' WHERE  `code` = '" . $voter . "'";
      mysql_query($query, $egatetif) or die(mysql_error());
      return;
    }
  }

  if (isset($_POST['voter'])) {
    $voter = $_POST['voter'];
    $votes = $_POST['projects'];
    if (count($votes) == 3 && is_allowed_to_vote($voter)) {
      record_vote($voter, $votes);
      redirect_to_ballot($voter);
    } else {
      echo '<meta charset="utf-8">';
      echo '<meta name="viewport" content="width=450; initial-scale=0.6;">';
      echo '<link rel="stylesheet" href="../style.css">';
      echo "You are allowed exactly 3 votes! Go back and choose THREE";
    }
  } else if (isset($_GET['voter'])) {
    $voter = $_GET['voter'];
    if (has_already_voted($voter)) {
      include "voted.php";
    } else if (is_allowed_to_vote($voter)) {
      include 'ballot.php';
    } else {
      echo '<meta charset="utf-8">';
      echo '<meta name="viewport" content="width=450; initial-scale=0.6;">';
      echo '<link rel="stylesheet" href="../style.css">';
      echo "Hrmm. ". $voter ." doesn’t look like a valid code.  <a href='../'>Try again</a>";
    }
  } else {
    echo '<meta charset="utf-8">';
    echo '<meta name="viewport" content="width=450; initial-scale=0.6;">';
    echo '<link rel="stylesheet" href="../style.css">';
    echo "I don’t know your voter coded! Enter it <a href='../'>back there</a>";
  }
?>
