<?php
  $votes = array(1,2,3); // fetch the votes
?>
<html>
<title>BG Hackathon Voting Ballot</title>
<body>
  <h1>Hey, <?php echo $voter; ?>, you voted!</h1>
  <?php echo $votes[0]; ?>
  <?php echo $votes[1]; ?>
  <?php echo $votes[2]; ?>
</body>
</html>
