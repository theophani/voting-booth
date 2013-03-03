<?php
  require_once('../db-config.php');

  function has_already_voted($voter) {
    // check if this voter code is used

    mysql_select_db($database_egatetif, $egatetif);
    $query = 'SELECT * FROM voters WHERE code = ' . $voter;
    $results = mysql_query($query, $egatetif) or die(mysql_error());
    $row = mysql_fetch_assoc($results);
    $total_results = mysql_num_rows($results);
    return $row['voted'];
  }

  function redirect_to_ballot($voter) {
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $params = '?voter=' . $voter;
    header("Location: http://$host$uri/$params");
  }

  function record_vote($voter, $votes) {
    if (!has_already_voted($voter)) {
      // record the vote
    }
  }

  if (isset($_POST['voter'])) {
    $voter = $_POST['voter'];
    $votes = $_POST['projects'];
    record_vote($voter, $votes);
    redirect_to_ballot($voter);
  } else if (isset($_GET['voter'])) {
    $voter = $_GET['voter'];
    if (has_already_voted($voter)) {
      include "voted.php";
    } else {
      include 'ballot.php';
    }
  } else {
    echo '<meta charset="utf-8">';
    echo "I don’t know your voter coded! Enter it <a href='../'>back there</a>";
  }
?>
