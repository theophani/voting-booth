<?php
  error_reporting(E_ALL);

  function has_already_voted($voter) {
    // check if this voter code is used …
    return true;
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
  } else {
    $voter = $_GET['voter'];
    if (has_already_voted($voter)) {
      include "voted.php";
    } else {
      include 'ballot.php';
    }
  }
?>
