<?php
  mysql_select_db($database_egatetif, $egatetif);
  $query = "SELECT * FROM hackathon_projects INNER JOIN hackathon_votes ON hackathon_projects.id = hackathon_votes.project_id WHERE hackathon_votes.voter_code = '" . $voter ."'";
  $votes = mysql_query($query, $egatetif) or die(mysql_error());
?>
<!doctype html>
<html>
<title>BG Hackathon Voting Ballot</title>
<meta charset="utf-8">
<meta name="viewport" content="width=450; initial-scale=0.6;">
<link rel="stylesheet" href="../style.css">
<body>
  <h1>Okay, you voted!</h1>
  <ul>
  <?php while ($vote = mysql_fetch_assoc($votes)) { ?>
    <li>
      <span class="run_order"><?php echo $vote['run_order']; ?></span>
      <span class="desc"><?php echo $vote['desc']; ?></span>
    </li>
  <?php } ?>
  </ul>
  <p>(You are seeing this because the code “<?php echo $voter; ?>” has been used.)</p>
</body>
</html>
